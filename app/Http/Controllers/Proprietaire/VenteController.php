<?php

namespace App\Http\Controllers\Proprietaire;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class VenteController extends Controller
{
    public function index()
    {
        // Récupérer le propriétaire connecté
        $proprietaire = Auth::user();

        // Récupérer toutes les ventes liées à ses biens
        $ventes = Transaction::with(['user', 'bien'])
            ->whereHas('bien', function ($q) use ($proprietaire) {
                $q->where('proprietaire_id', $proprietaire->id)
                  ->where('type', 'vente');
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('proprio.ventes', compact('ventes', 'proprietaire'));
    }
}
