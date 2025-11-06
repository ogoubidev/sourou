<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class AchatController extends Controller
{
    /**
     * Affiche tous les achats du client connecté.
     */
    public function index()
    {
        $user = Auth::user();

        // Récupérer toutes les transactions du client pour des biens de type "vente"
        $achats = Transaction::with('bien')
            ->where('user_id', $user->id)
            ->whereHas('bien', function ($query) {
                $query->where('type', 'vente');
            })
            ->orderByDesc('created_at')
            ->get();

        return view('client.achats', compact('achats'));
    }
}
