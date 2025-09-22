<?php

namespace App\Http\Controllers\Admin;

use App\Events\PaiementCree;
use App\Http\Controllers\Controller;
use App\Models\Paiement;
use App\Models\User;
use App\Notifications\PaiementEffectue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaiementController extends Controller
{
    // Afficher toutes les transactions
    public function index()
    {
        $paiements = Paiement::with('attribution.bien', 'attribution.client')
                        ->orderBy('date_paiement', 'desc')
                        ->get();

        // Récupérer l'admin
        $admin = Auth::user();

        return view('admin.paiements', compact('paiements', 'admin'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'attribution_id' => 'required|exists:attributions,id',
            'montant'        => 'required|numeric|min:100',
            'mode'           => 'string',
        ]);

        $paiement = Paiement::create([
            'attribution_id' => $request->attribution_id,
            'montant'        => $request->montant,
            'date_paiement'  => now(),
            'status_paiement' => 'paye',
        ]);

        // Incrémenter le compteur de paiements
        $attribution = $paiement->attribution;
        $attribution->increment('paiements_effectues');

        // Vérifier si tout est payé
        if ($attribution->paiements_effectues >= $attribution->mois_total) {
            $attribution->update(['statut_paiement' => 'paye']);
        }

        // Notifier l'admin
        $admin = User::where('role', 'admin')->first();
        if ($admin) {
            $admin->notify(new PaiementEffectue($paiement));
        }

        return response()->json(['success' => true, 'paiement' => $paiement]);
    }
}
