<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bien;
use App\Models\Depense;
use App\Models\User;

use App\Notifications\DepenseEnregistree;

use App\Notifications\NouvelleDepenseNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;


class DepenseController extends Controller
{
    public function index()
    {
        $depenses = Depense::with('bien')->latest()->get();
        $biens = Bien::all();

        return view('admin.depenses.index', compact('depenses', 'biens'));
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'bien_id' => 'required|exists:biens,id',
        'type' => 'required|string|max:255',
        'montant' => 'required|numeric|min:0',
        'date_depense' => 'required|date',
        'prestataire' => 'nullable|string|max:255',
        'description' => 'nullable|string',
    ]);

    $depense = Depense::create($validated);

    $bien = Bien::find($depense->bien_id);

    if ($bien && $bien->proprietaire) {
        $bien->proprietaire->notify(new NouvelleDepenseNotification($depense));
    }

    return redirect()->back()->with('success', 'Dépense enregistrée avec succès ');
}


    public function edit(Depense $depense)
    {
        $biens = Bien::all();
        return view('admin.depenses.edit', compact('depense', 'biens'));
    }

    public function update(Request $request, Depense $depense)
    {
        $validated = $request->validate([
            'bien_id' => 'required|exists:biens,id',
            'type' => 'required|string|max:255',
            'montant' => 'required|numeric|min:0',
            'date_depense' => 'required|date',
            'prestataire' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $depense->update($validated);

        return redirect()->route('admin.depenses.index')->with('success', 'Dépense mise à jour avec succès ✏️');
    }

    public function destroy(Depense $depense)
    {
        $depense->delete();

        return redirect()->back()->with('success', 'Dépense supprimée avec succès 🗑️');
    }
}
