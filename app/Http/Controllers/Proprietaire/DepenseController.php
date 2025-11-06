<?php

namespace App\Http\Controllers\Proprietaire;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Depense;

class DepenseController extends Controller
{
    public function index()
    {
        // Récupère uniquement les dépenses des biens du propriétaire connecté
        $depenses = Depense::whereHas('bien', function ($query) {
            $query->where('proprietaire_id', auth()->id());
        })->with('bien')->latest()->get();

        return view('proprio.depenses.index', compact('depenses'));
    }
}
