<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Attribution;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

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

    // Télécharger le contrat PDF d'une attribution spécifique
    public function download(Attribution $attribution)
    {
        // Vérifie que l'attribution appartient bien au client connecté
        if ($attribution->client_id !== auth()->id()) {
            abort(403, "Vous n'avez pas accès à ce contrat.");
        }

        // Génère le PDF depuis la vue proprio/pdfs/contrat.blade.php
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('proprio.pdfs.contrat', [
            'attribution' => $attribution
        ]);

        $filename = 'Contrat_' . $attribution->id . '.pdf';
        return $pdf->download($filename);
    }
}
