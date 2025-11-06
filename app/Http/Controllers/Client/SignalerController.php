<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Signalement;
use Illuminate\Support\Facades\Auth;

class SignalerController extends Controller
{
    /**
     * Afficher tous les signalements du client connecté
     */
    public function index()
    {
        $client = Auth::user();
        $signalements = Signalement::where('client_id', $client->id)->latest()->get();

        return view('client.signalements.index', compact('signalements'));
    }

    /**
     * Afficher le formulaire pour créer un nouveau signalement
     */
    public function create()
    {
        return view('client.signalements.create');
    }

    /**
     * Enregistrer un nouveau signalement
     */
    public function store(Request $request)
    {
        $request->validate([
            'categorie' => 'nullable|string|max:255',
            'description' => 'required|string',
        ]);

        Signalement::create([
            'client_id' => Auth::id(),
            'categorie' => $request->categorie,
            'description' => $request->description,
            'statut' => 'en_attente',
        ]);

        return redirect()->route('client.signalements.index')
            ->with('success', 'Votre problème a été signalé avec succès.');
    }

    /**
     * Afficher un signalement précis
     */
    public function show($id)
    {
        $signalement = Signalement::where('client_id', Auth::id())->findOrFail($id);
        return view('client.signalements.show', compact('signalement'));
    }

    /**
     * Formulaire pour modifier un signalement (optionnel)
     */
    public function edit($id)
    {
        $signalement = Signalement::where('client_id', Auth::id())->findOrFail($id);
        return view('client.signalements.edit', compact('signalement'));
    }

    /**
     * Mettre à jour un signalement
     */
    public function update(Request $request, $id)
    {
        $signalement = Signalement::where('client_id', Auth::id())->findOrFail($id);

        $request->validate([
            'categorie' => 'nullable|string|max:255',
            'description' => 'required|string',
        ]);

        $signalement->update([
            'categorie' => $request->categorie,
            'description' => $request->description,
        ]);

        return redirect()->route('client.signalements.index')
            ->with('success', 'Signalement mis à jour avec succès.');
    }

    /**
     * Supprimer un signalement
     */
    public function destroy($id)
    {
        $signalement = Signalement::where('client_id', Auth::id())->findOrFail($id);
        $signalement->delete();

        return redirect()->route('client.signalements.index')
            ->with('success', 'Signalement supprimé avec succès.');
    }
}
