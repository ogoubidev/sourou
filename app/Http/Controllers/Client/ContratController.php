<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Attribution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContratController extends Controller
{
    public function index()
    {
        // Récupère toutes les attributions du client avec le bien et le propriétaire
        $attributions = Attribution::with('bien.proprietaire')
            ->where('client_id', Auth::id())
            ->get();

        // S'assure que loyer_mensuel est rempli, sinon prend le prix du bien
        foreach ($attributions as $a) {
            if ((!$a->loyer_mensuel || $a->loyer_mensuel == 0) && $a->bien) {
                $a->loyer_mensuel = $a->bien->prix; 
            }
        }

        return view('client.contrats', compact('attributions'));
    }
}
