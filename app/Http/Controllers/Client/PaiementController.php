<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Paiement;
use Illuminate\Support\Facades\Auth;

class PaiementController extends Controller
{
    public function index()
    {
        $clientId = Auth::id();

        // Récupère tous les paiements liés aux attributions du client connecté
        $paiements = Paiement::with(['attribution.bien', 'attribution.client'])
            ->whereHas('attribution', function ($q) use ($clientId) {
                $q->where('client_id', $clientId);
            })
            ->orderByDesc('date_paiement')
            ->get();

        $base = Paiement::whereHas('attribution', fn($q) => $q->where('client_id', $clientId));
        $stats = [
            'total_paye'         => (clone $base)->where('status_paiement', 'paye')->sum('montant'),
            'total_reste_a_payer'=> (clone $base)->where('status_paiement', 'reste_a_payer')->sum('montant'),
            'total_impaye'       => (clone $base)->where('status_paiement', 'impaye')->sum('montant'),
        ];

        return view('client.paiements', compact('paiements', 'stats'));
    }
}
