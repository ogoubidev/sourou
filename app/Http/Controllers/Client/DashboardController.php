<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Attribution;
use App\Models\Paiement;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $clienId = Auth::id();

        // Les attributions du client connecté
        $attributions = Attribution::with('bien.proprietaire')
            ->where('client_id', $clienId)
            ->take(5)
            ->get();

        // Nombre total de biens loués
        $nbBiensLoue = $attributions->count();

        // Nombre de propriétaires distincts
        $nbProprietaires = $attributions->pluck('bien.proprietaire.id')->unique()->count();

        // Dernières transactions
        $transactionsRecentes = Paiement::with('attribution.bien', 'attribution.client')
            ->whereHas('attribution', fn($q) => $q->where('client_id', $clienId))
            ->latest()
            ->get();

        // Dernières attributions
        $attributionsRecentes = Attribution::with(['bien', 'client'])
            ->where('client_id', $clienId)
            ->latest('date_debut')
            ->take(5)
            ->get();

        // Infos du client connecté
        $client = Auth::user();        

        // Liste des utilisateurs clients
        $UsersClient = User::where('role', 'client')
            ->select('name', 'surname')
            ->get();

        return view('client.dashboard', compact(
            'attributions',
            'nbBiensLoue',
            'nbProprietaires',
            'UsersClient',
            'client',
            'transactionsRecentes',
            'attributionsRecentes',
            'clienId'
        ));
    }    

    public function mesContrats()
    {
        $attributions = Attribution::with(['bien.proprietaire', 'client'])
            ->where('client_id', auth()->id())
            ->get();

        return view('client.contrats', compact('attributions'));
    }
}
