<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribution;
use App\Models\Bien;
use App\Models\Location;
use Illuminate\Http\Request;

class DemandeController extends Controller
{
    public function index()
    {
        $this->synchroniserBiens();

        $demandes = Location::with('bien', 'user')
                    ->where('statut', 'en_attente')
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view('admin.demandes.index', compact('demandes'));
    }

    // Page Historique -> toutes les demandes
    public function historique()
    {
        $demandes = Location::with('bien', 'user')
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view('admin.demandes.historique', compact('demandes'));
    }

    public function approuver(Request $request, Location $demande)
    {
        if ($demande->statut !== 'en_attente') {
            return redirect()->back()->with('error', 'Cette demande a déjà été traitée.');
        }

        $request->validate([
            'loyer_mensuel' => 'required|numeric|min:100',
        ]);

        if ($demande->bien->statut === 'attribue') {
            return redirect()->back()->with('error', 'Ce bien a déjà été attribué.');
        }

        // Mise à jour
        $demande->update(['statut' => 'approuve']);
        $demande->bien->update(['statut' => 'attribue']);

        // dd($demande->statut, $demande->bien->statut);

        Attribution::create([
            'bien_id'        => $demande->bien->id,
            'proprietaire_id'=> $demande->bien->proprietaire_id,
            'client_id'      => $demande->user_id,
            'date_debut'     => $demande->date_debut,
            'date_fin'       => $demande->date_fin,
            'loyer_mensuel'  => $request->loyer_mensuel,
        ]);

        return redirect()->route('admin.demandes.index')
                         ->with('success', 'La demande a été approuvée.');
    }

    private function synchroniserBiens()
    {
        $biens = Bien::with('attributions')->get();

        foreach ($biens as $bien) {
            $lastAtt = $bien->attributions->last();

            if ($lastAtt && $lastAtt->date_fin < now() && $bien->statut === 'attribue') {
                $lastAtt->update(['status' => 'terminee']);
                $bien->update(['statut' => 'disponible']);
            }
        }
    }
}
