<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Paiement;
use App\Models\Attribution;
use Illuminate\Http\Request;

class PaiementController extends Controller
{
    public function index()
    {
        $paiements = Paiement::whereHas('attribution', function ($q) {
            $q->where('client_id', auth()->id());
        })->latest()->get();

        return view('client.paiements.index', compact('paiements'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'attribution_id' => 'required|exists:attributions,id',
            'montant'        => 'required|numeric|min:1',
        ]);
    
        $attribution = Attribution::findOrFail($request->attribution_id);
    
        // Enregistrement du paiement
        $paiement = Paiement::create([
            'attribution_id'  => $attribution->id,
            'montant'         => $request->montant,
            'date_paiement'   => now(),
            'mode'            => 'mobile_money',
            'status_paiement' => 'paye',
        ]);
    
        $attribution->increment('paiements_effectues');
    
        if ($attribution->paiements_effectues >= $attribution->mois_total) {
            $attribution->update(['statut_paiement' => 'paye']);
        }
    
        // Générer le PDF du reçu
        $pdf = Pdf::loadView('proprio.pdfs.facture_paiement', [
            'paiement' => $paiement,
            'attribution' => $attribution
        ]);
    
        // Sauvegarder dans storage temporaire
        $pdfPath = 'factures/facture_'.$paiement->id.'.pdf';
        $pdf->save(storage_path('app/public/'.$pdfPath));
    
        return response()->json([
            'success'  => true,
            'message'  => 'Paiement enregistré avec succès',
            'paiement' => $paiement,
            'paiements_effectues' => $attribution->paiements_effectues,
            'pdf_url'  => asset('storage/'.$pdfPath)
        ]);
    }
    
}
