<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribution;
use App\Models\Bien;
use App\Models\Paiement;
use App\Models\User;
use Illuminate\Http\Request;

use App\Models\Transaction;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistiques générales
        $nombreProprio = \App\Models\User::where('role', 'proprietaire')->count();
        $nombreClients = \App\Models\User::where('role', 'client')->count();
        $nombreBiens = \App\Models\Bien::count();
        $nombreTransactions = Transaction::count();

        $transactions = Paiement::with('attribution.bien', 'attribution.client')
            ->latest()
            ->take(10)
            ->get();

        $attributions = \App\Models\Attribution::with('client', 'bien')
            ->latest()
            ->take(10)
            ->get();

        /**
         * Données pour les graphiques
         * On regroupe les paiements (location) et transactions (vente) par mois
         */
        $locationData = Paiement::selectRaw('MONTH(date_paiement) as mois, SUM(montant) as total')
            ->groupBy('mois')
            ->orderBy('mois')
            ->get();

        $venteData = Transaction::selectRaw('MONTH(created_at) as mois, SUM(montant) as total')
            ->groupBy('mois')
            ->orderBy('mois')
            ->get();

        // Formatage pour le JS (ex: ["Jan", "Fév", ...])
        $labels = collect(range(1, 12))->map(function ($m) {
            return Carbon::create()->month($m)->locale('fr')->isoFormat('MMM');
        });

        // On prépare les séries
        $locationTotals = $labels->map(fn($m, $i) => optional($locationData->firstWhere('mois', $i + 1))->total ?? 0);
        $venteTotals = $labels->map(fn($m, $i) => optional($venteData->firstWhere('mois', $i + 1))->total ?? 0);

        return view('admin.dashboard', compact(
            'nombreProprio', 'nombreClients', 'nombreBiens', 'nombreTransactions',
            'transactions', 'attributions', 'labels', 'locationTotals', 'venteTotals'
        ));
    }

    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
