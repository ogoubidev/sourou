<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\Attribution;

class DemandeController extends Controller
{
    // Afficher toutes les demandes
    public function index()
    {
        $demandes = Location::with('bien', 'user')
                    ->where('statut', 'en_attente')
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view('admin.demandes.index', compact('demandes'));
    }

    // Approuver une demande
    public function approuver(Request $request, Location $demande)
    {
        $request->validate([
            'loyer_mensuel' => 'required|numeric|min:100',
        ]);
    
        if ($demande->bien->statut === 'attribue') {
            return redirect()->back()->with('error', 'Ce bien a déjà été attribué.');
        }
    
        // Mise à jour des statuts
        $demande->update(['statut' => 'approuve']);
        $demande->bien->update(['statut' => 'attribue']);
    
        // Créer l’attribution avec le loyer renseigné
        Attribution::create([
            'bien_id'        => $demande->bien->id,
            'proprietaire_id'=> $demande->bien->proprietaire_id,
            'client_id'      => $demande->user_id,
            'date_debut'     => $demande->date_debut,
            'date_fin'       => $demande->date_fin,
            'loyer_mensuel'  => $request->loyer_mensuel,
        ]);
    
        return redirect()->back()->with('success', 'La demande a été approuvée et l’attribution a été créée avec le loyer renseigné.');
    }
    
}
