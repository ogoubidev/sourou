<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Paiement;
use App\Models\User;
use App\Notifications\PaiementEffectue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaiementController extends Controller
{
    // Afficher toutes les transactions
    public function index()
    {
        $paiements = Paiement::with('attribution.bien', 'attribution.client')
                        ->orderBy('date_paiement', 'desc')
                        ->get();

        // Récupérer l'admin connecté
        $admin = Auth::user();

        return view('admin.paiements', compact('paiements', 'admin'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'attribution_id' => 'required|exists:attributions,id',
            'montant'        => 'required|numeric|min:100',
            'mode'           => 'required|string',
        ]);

        $paiement = Paiement::create([
            'attribution_id' => $request->attribution_id,
            'montant'        => $request->montant,
            'date_paiement'  => now(),
            'mode'           => $request->mode,
        ]);

        // Notifier l'admin (supposons user_id = 1 pour l'admin principal)
        $admin = User::where('role', 'admin')->first();
        if ($admin) {
            $admin->notify(new PaiementEffectue($paiement));
        }

        return response()->json(['success' => true, 'paiement' => $paiement]);
    }
}
