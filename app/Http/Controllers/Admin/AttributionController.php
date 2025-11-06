<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribution;
use App\Models\Bien;
use App\Models\User;
use App\Notifications\AttributionCreee;

use App\Notifications\AttributionRelancee;
use App\Notifications\AttributionTerminee;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttributionController extends Controller
{

    public function index()
    {
        $this->synchroniserBiens();

        $attributions = Attribution::with(['bien', 'client'])->get();
        return view('admin.attributions.index', compact('attributions'));
    }

    public function create()
    {
        $biens = Bien::where('statut', 'disponible')->get();
        $clients = User::where('role', 'client')->get();
        return view('admin.attributions.create', compact('biens', 'clients'));
    }

    public function store(Request $request)
    {
        // Validation
        $validated = $request->validate([
            'bien_id'      => 'required|exists:biens,id',
            'client_id'    => 'required|exists:users,id',
            'date_debut'   => 'required|date',
            'date_fin'     => 'required|date|after:date_debut',
            'loyer_mensuel'=> 'required|numeric|min:0',
        ]);

        $validated['date_attribution'] = now()->toDateString();
        $validated['mois_total'] = Carbon::parse($validated['date_debut'])->diffInMonths(Carbon::parse($validated['date_fin'])) + 1;
        
        $attribution = Attribution::create($validated);

        // Mettre le bien en statut "attribue" pour empecher plusieurs locataire de louer le meme bien dans la meme période
        $attribution->bien->update(['statut' => 'attribue']);

        // Notifications ( On vérifie que le clien ou le propriétaire existe belle et bien pour éviter les risques de plantage  de nottre App Web )
        if ($attribution->client) {
            $attribution->client->notify(new AttributionCreee($attribution));
        }
        if ($attribution->bien && $attribution->bien->proprietaire) {
            $attribution->bien->proprietaire->notify(new AttributionCreee($attribution));
        }

        return redirect()->route('admin.attributions.index')
            ->with('success', 'Attribution créée avec succès et notifications envoyées.');
    }


    private function synchroniserBiens()
    {
        $biens = Bien::with('attributions')->get();

        foreach ($biens as $bien) {
            $lastAtt = $bien->attributions->last();

            if ($lastAtt && $lastAtt->date_fin < now() && $bien->statut === 'attribue') {
                $lastAtt->update(['status' => 'terminee']);
                $bien->update(['statut' => 'disponible']);
            }
        }
    }    

    
    public function terminer(Attribution $attribution)
    {

        // Cas 1 : l'attribution n'a pas encore commencé
        if ($attribution->date_debut > now()) {
            return redirect()->route('admin.attributions.index')
                ->with('error', 'Impossible de terminer une attribution qui n’a pas encore commencé. Vous pouvez plutôt l’annuler.');
        }
        
        $attribution->update([
            'date_fin' => now(),
        ]);
    
        $attribution->bien->update(['statut' => 'disponible']);
    
        // Notifications
        if ($attribution->client) {
            $attribution->client->notify(new AttributionTerminee($attribution));
        }
        if ($attribution->bien && $attribution->bien->proprietaire) {
            $attribution->bien->proprietaire->notify(new AttributionTerminee($attribution));
        }
    
        return redirect()->route('admin.attributions.index')
            ->with('success', 'Attribution terminée et notifications envoyées.');
    }
    
    public function relancer(Request $request, Attribution $attribution)
    {
        $validated = $request->validate([
            'date_debut' => 'required|date|after_or_equal:today',
            'date_fin'   => 'required|date|after:date_debut',
        ]);
    
        $attribution->update([
            'date_debut' => $validated['date_debut'],
            'date_fin'   => $validated['date_fin'],
        ]);

        $attribution->update([
            'mois_total' => Carbon::parse($validated['date_debut'])->diffInMonths(Carbon::parse($validated['date_fin'])) + 1
        ]);

        if ($attribution->bien) {
            $attribution->bien->update(['statut' => 'attribue']);
        }
    
        // Notifications
        if ($attribution->client) {
            $attribution->client->notify(new AttributionRelancee($attribution));
        }
        if ($attribution->bien && $attribution->bien->proprietaire) {
            $attribution->bien->proprietaire->notify(new AttributionRelancee($attribution));
        }
    
        return redirect()->route('admin.attributions.index')
            ->with('success', 'Attribution relancée et notifications envoyées.');
    }

    public function annuler(Attribution $attribution)
    {
        // Vérifier que c’est bien une attribution à venir
        if ($attribution->date_debut <= now()) {
            return redirect()->route('admin.attributions.index')
                ->with('error', 'Seules les attributions à venir peuvent être annulées.');
        }

        // Remettre le bien en disponible
        if ($attribution->bien) {
            $attribution->bien->update(['statut' => 'disponible']);
        }

        // Supprimer l’attribution
        $attribution->delete();

        return redirect()->route('admin.attributions.index')
            ->with('success', 'Attribution annulée avec succès.');
    }


}
