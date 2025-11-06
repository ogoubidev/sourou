<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Signalement;
use Illuminate\Http\Request;

class SignalementController extends Controller
{
    // Affiche tous les signalements
    public function index()
    {
        $signalements = Signalement::with('client')->latest()->get();
        return view('admin.signalements.index', compact('signalements'));
    }

    // Affiche le formulaire de modification pour un signalement
    public function edit(Signalement $signalement)
    {
        return view('admin.signalements.edit', compact('signalement'));
    }

    // Met à jour le statut ou la réponse admin
    public function update(Request $request, Signalement $signalement)
    {
        $request->validate([
            'statut' => 'required|in:en_attente,en_cours,resolu',
            'reponse_admin' => 'nullable|string',
        ]);

        $signalement->update([
            'statut' => $request->statut,
            'reponse_admin' => $request->reponse_admin,
        ]);

        return redirect()->route('admin.signalements.index')->with('success', 'Signalement mis à jour avec succès.');
    }

    // Optionnel : supprimer un signalement
    public function destroy(Signalement $signalement)
    {
        $signalement->delete();
        return redirect()->route('admin.signalements.index')->with('success', 'Signalement supprimé.');
    }
}
