<?php

namespace App\Http\Controllers\Proprietaire;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Attribution;
use App\Models\Bien;
use App\Models\Paiement;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LoyersExport;

class DashboardController extends Controller
{

    public function index()
    {
        $proprioId = Auth::id();
    
        // Totaux existants
        $nombreLocataires  = Attribution::whereHas('bien', fn($q) => $q->where('proprietaire_id', $proprioId))->count();
        $nombreBiens       = Bien::where('proprietaire_id', $proprioId)->count();
        $nombreAttributions= Attribution::whereHas('bien', fn($q) => $q->where('proprietaire_id', $proprioId))->count();
        $nombreTransactions= Paiement::whereHas('attribution.bien', fn($q) => $q->where('proprietaire_id', $proprioId))->count();
    
        // Taux d'occupation
        $biensLoues = Attribution::whereHas('bien', fn($q) => $q->where('proprietaire_id', $proprioId))
                        ->where('date_fin', '>=', Carbon::now())
                        ->count();
        $tauxOccupation = $nombreBiens > 0 ? round(($biensLoues / $nombreBiens) * 100, 1) : 0;
    
        // Loyers encaissés par mois pour l'année en cours
        $moisLabels = [];
        $loyersMois = [];
        for ($i = 1; $i <= 12; $i++) {
            $moisLabels[] = Carbon::create()->month($i)->format('M');
            $loyersMois[] = Paiement::whereHas('attribution.bien', fn($q) => $q->where('proprietaire_id', $proprioId))
                                ->whereYear('created_at', Carbon::now()->year)
                                ->whereMonth('created_at', $i)
                                ->sum('montant');
        }
    
        $proprio = Auth::user();
    
        // Transactions et attributions récentes
        $transactionsRecentes = Paiement::with('attribution.bien', 'attribution.client')
            ->whereHas('attribution.bien', fn($q) => $q->where('proprietaire_id', $proprioId))
            ->latest()
            ->take(5)
            ->get();
    
        $attributionsRecentes = Attribution::with(['bien', 'client'])
            ->whereHas('bien', fn($q) => $q->where('proprietaire_id', $proprioId))
            ->latest('date_debut')
            ->take(5)
            ->get();
    
        return view('proprio.dashboard', compact(
            'nombreLocataires', 
            'nombreBiens', 
            'nombreAttributions', 
            'nombreTransactions', 
            'transactionsRecentes', 
            'attributionsRecentes',
            'proprio',
            'tauxOccupation',
            'moisLabels',
            'loyersMois'
        ));
    }
    

    public function mesLocataires()
    {
        $attributions = Attribution::with(['bien', 'client'])
            ->whereHas('bien', function($query) {
                $query->where('proprietaire_id', auth()->id());
            })
            ->orderBy('date_debut', 'desc')
            ->get();

        return view('proprio.locataire', compact('attributions'));
    }

    public function historiqueLoyers(Request $request)
    {
        $proprietaireId = auth()->id();
    
        $mois = $request->get('mois');
        $annee = $request->get('annee', now()->year);
    
        $paiements = Paiement::with(['attribution.bien', 'attribution.client'])
            ->whereHas('attribution.bien', fn($q) => $q->where('proprietaire_id', $proprietaireId))
            ->when($mois, fn($q) => $q->whereMonth('created_at', $mois))
            ->when($annee, fn($q) => $q->whereYear('created_at', $annee))
            ->orderBy('created_at', 'desc')
            ->get();
    
        // Calcul du reste à payer pour chaque attribution
        foreach ($paiements as $paiement) {
            $attrib = $paiement->attribution;
            if ($attrib) {
                $moisTotal = $attrib->mois_total ?? 0;
                $moisPayes = $attrib->paiements_effectues ?? 0;
                $loyerMensuel = $attrib->loyer ?? 0;
    
                $moisRestants = max($moisTotal - $moisPayes, 0);
                $paiement->reste_a_payer = $moisRestants * $loyerMensuel;
            } else {
                $paiement->reste_a_payer = 0;
            }
        }
    
        return view('proprio.paiement', compact('paiements', 'mois', 'annee'));
    }



    public function exportPaiementPdf($id, Request $request)
    {
        $paiement = Paiement::with(['attribution.bien', 'attribution.client'])->findOrFail($id);
        
        // Mois concerné déterminé par la date de paiement

        $mois_concerne = $paiement->date_paiement ? $paiement->date_paiement->translatedFormat('F') : Carbon::now()->translatedFormat('F');


        $pdf = Pdf::loadView('proprio.pdfs.facture_paiement', compact('paiement', 'mois_concerne'))
                ->setPaper('a4', 'portrait');

        $nomFichier = 'facture_payé_pour_le_mois_de_' 
            . strtolower(str_replace(' ', '_', $mois_concerne))
            . '_par_le_client_' 
            . str_replace(' ', '_', $paiement->attribution->client->name ?? 'inconnu')
            . '.pdf';

        return $pdf->download($nomFichier);
    }




    // Exportation paiement
    public function exportLoyers($format, Request $request)
    {
        $proprietaireId = auth()->id();
        $mois = $request->get('mois');
        $annee = $request->get('annee', now()->year);

        $paiements = Paiement::with(['attribution.bien', 'attribution.client'])
            ->whereHas('attribution.bien', fn($q) => $q->where('proprietaire_id', $proprietaireId))
            ->when($mois, fn($q) => $q->whereMonth('created_at', $mois))
            ->when($annee, fn($q) => $q->whereYear('created_at', $annee))
            ->get();

        if ($format === 'pdf') {
            $pdf = Pdf::loadView('exports.paiements_pdf', compact('paiements', 'mois', 'annee'));
            return $pdf->download("historique_paiements_{$annee}_{$mois}.pdf");
        }

        // if ($format === 'excel') {
        //     return Excel::download(new LoyersExport($paiements), "historique_paiements_{$annee}_{$mois}.xlsx");
        // }

        abort(404);
    }



    public function contratPDF($id)
    {
        $attribution = Attribution::with(['bien', 'client'])
            ->whereHas('bien', fn($q) => $q->where('proprietaire_id', auth()->id()))
            ->findOrFail($id);

        $pdf = Pdf::loadView('proprio.pdfs.contrat', compact('attribution'))
                ->setPaper('a4', 'portrait');

        return $pdf->download('contrat_'.$attribution->id.'.pdf');
    }

    public function fichePDF($id)
    {
        $attribution = Attribution::with(['bien', 'client'])
            ->whereHas('bien', fn($q) => $q->where('proprietaire_id', auth()->id()))
            ->findOrFail($id);

        $pdf = Pdf::loadView('proprio.pdfs.fiche_locataire', compact('attribution'))
                ->setPaper('a4', 'portrait');

        return $pdf->stream('fiche_locataire_'.$attribution->client->name.'.pdf');
    }



}
