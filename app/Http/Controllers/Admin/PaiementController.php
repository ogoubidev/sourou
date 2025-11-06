<?php

namespace App\Http\Controllers\Admin;

use App\Events\PaiementCree;
use App\Http\Controllers\Controller;
use App\Models\Paiement;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Bien;
use App\Notifications\PaiementEffectue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PaiementController extends Controller
{
    // Afficher toutes les transactions (location + vente)
    public function index()
    {
        // Récupérer l'admin connecté
        $admin = Auth::user();

        // Transactions de location
        $paiements = Paiement::with(['attribution.client', 'attribution.bien'])
            ->whereHas('attribution.bien', function($q) {
                $q->where('type', 'location');
            })
            ->orderByDesc('date_paiement')
            ->get();

        // Transactions de vente
        $ventes = Transaction::with(['user', 'bien'])
            ->whereHas('bien', function($q) {
                $q->where('type', 'vente');
            })
            ->orderByDesc('created_at')
            ->get();

        return view('admin.paiements', compact('paiements', 'ventes', 'admin'));
    }

 

    public function downloadProof($id)
    {
        $vente = \App\Models\Transaction::findOrFail($id);
    
        if (!$vente->proof_path) {
            return redirect()->back()->with('error', 'Aucune preuve disponible pour cette vente.');
        }
    
        // Si le chemin est stocké comme "proofs/nom_du_fichier.pdf"
        $path = $vente->proof_path;
    
        // Si c’est un fichier dans le disque "public"
        if (Storage::disk('public')->exists($path)) {
            return Storage::disk('public')->download($path);
        }
    
        // Si c’est un chemin absolu dans public/
        $fullPath = public_path($path);
        if (file_exists($fullPath)) {
            return response()->download($fullPath);
        }
    
        return redirect()->back()->with('error', 'Fichier introuvable sur le serveur.');
    }
    


    //Enregistrer un paiement (cas de location)
    public function store(Request $request)
    {
        $request->validate([
            'attribution_id' => 'required|exists:attributions,id',
            'montant'        => 'required|numeric|min:100',
            'mode'           => 'string',
        ]);

        $paiement = Paiement::create([
            'attribution_id'  => $request->attribution_id,
            'montant'         => $request->montant,
            'date_paiement'   => now(),
            'status_paiement' => 'paye',
        ]);

        $attribution = $paiement->attribution;
        $bien = $attribution->bien;

        // Incrémenter le compteur de paiements effectués
        $attribution->increment('paiements_effectues');

        // Si tout est payé
        if ($attribution->paiements_effectues >= $attribution->mois_total) {
            $attribution->update(['statut_paiement' => 'paye']);

            // Mettre à jour le statut du bien
            if ($bien) {
                $bien->update(['statut' => 'loué']);
            }
        }

        // Notifier l’admin
        $admin = User::where('role', 'admin')->first();
        if ($admin) {
            $admin->notify(new PaiementEffectue($paiement));
        }

        return response()->json(['success' => true, 'paiement' => $paiement]);
    }

    // Mise à jour manuelle d’une vente par l’admin
    public function updateVente(Request $request, $id)
    {
        $request->validate([
            'statut' => 'required|in:en_attente,reussi,echoue',
        ]);

        $vente = Transaction::with('bien')->findOrFail($id);
        $vente->statut = $request->statut;
        $vente->save();

        // Si la vente est réussie, marquer le bien comme "vendu"
        if ($vente->statut === 'reussi' && $vente->bien) {
            $vente->bien->update(['statut' => 'vendu']);
        }

        return redirect()->back()->with('success', 'Statut mis à jour avec succès.');
    }
}
