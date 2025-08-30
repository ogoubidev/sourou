<?php

namespace App\Http\Controllers\Proprietaire;

use App\Http\Controllers\Controller;
use App\Models\Attribution;
use App\Models\Bien;
use App\Models\Paiement;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $proprioId = Auth::id();

        // Totaux
        $nombreLocataires  = Attribution::whereHas('bien', fn($q) => $q->where('proprietaire_id', $proprioId))->count();
        $nombreBiens       = Bien::where('proprietaire_id', $proprioId)->count();
        $nombreAttributions= Attribution::whereHas('bien', fn($q) => $q->where('proprietaire_id', $proprioId))->count();
        $nombreTransactions= Paiement::whereHas('attribution.bien', fn($q) => $q->where('proprietaire_id', $proprioId))->count();

        // Dernières transactions
        $transactionsRecentes = Paiement::with('attribution.bien', 'attribution.client')
            ->whereHas('attribution.bien', fn($q) => $q->where('proprietaire_id', $proprioId))
            ->latest()
            ->take(5)
            ->get();

        // Derniers articles (si tu en as liés au proprio)
        $articlesRecents = Bien::latest()->take(5)->get();

        return view('proprio.dashboard', compact(
            'nombreLocataires', 
            'nombreBiens', 
            'nombreAttributions', 
            'nombreTransactions', 
            'transactionsRecentes', 
            'articlesRecents'
        ));
    }

    public function mesLocataires()
    {
        $attributions = Attribution::with(['bien', 'client'])
            ->whereHas('bien', function($query) {
                $query->where('proprietaire_id', auth()->id());
            })
            ->orderBy('date_debut', 'desc')
            ->get();

        return view('proprio.locataire', compact('attributions'));
    }

    public function historiqueLoyers()
    {
        $paiements = Paiement::with(['attribution.bien', 'attribution.client'])
            ->whereHas('attribution.bien', function($q) {
                $q->where('proprietaire_id', auth()->id());
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('proprio.paiement', compact('paiements'));
    }


}
