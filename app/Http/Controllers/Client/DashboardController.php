<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Attribution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $attributions = Attribution::with('bien.proprietaire')
            ->where('client_id', Auth::id())
            ->get();

        // Nombre total de biens loués
        $nbBiensLoue = $attributions->count();

        // Nombre de propriétaires distincts
        $nbProprietaires = $attributions
            ->pluck('bien.proprietaire.id')
            ->unique()
            ->count();



        return view('client.dashboard', compact('attributions', 'nbBiensLoue', 'nbProprietaires'));
    }    

    public function mesContrats()
    {
        $attributions = Attribution::with(['bien.proprietaire', 'client'])
            ->where('client_id', auth()->id())
            ->get();

        return view('client.contrats', compact('attributions'));
    }
}
