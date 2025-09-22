<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Attribution;
use App\Models\Paiement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContratController extends Controller
{
        public function index()
        {
            $attributions = Attribution::with(['paiements', 'bien.proprietaire'])
                ->where('client_id', Auth::id())
                ->where('statut_paiement', '!=', 'paye')
                ->get();
        
            foreach ($attributions as $a) {
                if ((!$a->loyer_mensuel || $a->loyer_mensuel == 0) && $a->bien) {
                    $a->loyer_mensuel = $a->bien->prix; 
                }
            }
        
            $client = Auth::user();        
        
            return view('client.contrats', compact('attributions', 'client'));
        }

    public function historique()
    {
        $attributionsPayees = Attribution::where('client_id', auth()->id())
            ->where('statut_paiement', 'paye')
            ->with('bien')
            ->get();

        return view('client.contrats_historique', compact('attributionsPayees'));
    }

}
