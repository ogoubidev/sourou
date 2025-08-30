<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribution;
use App\Models\Bien;
use App\Models\User;
use App\Notifications\AttributionCreee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AttributionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attributions = Attribution::with(['bien', 'client'])->get();
        return view('admin.attributions.index', compact('attributions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $biens = Bien::where('statut', 'disponible')->get();
        $clients = User::where('role', 'client')->get();
        return view('admin.attributions.create', compact('biens', 'clients'));
    }



    /**
     * @property \Carbon\Carbon|null $date_debut
     * @property \Carbon\Carbon|null $date_fin
     * @property \Carbon\Carbon|null $date_attribution
     */
    public function getStatusAttribute()
    {
        $today = now()->startOfDay(); // aujourd’hui à 00:00
    
        if ($this->date_fin && $today->gt($this->date_fin)) {
            return 'terminee'; // si la date de fin est passée
        }
    
        if ($this->date_debut && $today->lt($this->date_debut)) {
            return 'à venir'; // si la date de début n’est pas encore arrivée
        }
    
        return 'active'; // sinon c’est en cours
    }
    

    public function terminer(Attribution $attribution)
    {
        // On définit la date de fin au jour actuel
        $attribution->update([
            'date_fin' => now(),
        ]);

        // On remet le bien disponible
        if($attribution->bien) {
            $attribution->bien->update(['statut' => 'disponible']);
        }

        return redirect()->route('admin.attributions.index')
                        ->with('success', 'Attribution terminée avec succès.');
    }



    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        // Validation
        $validated = $request->validate([
            'bien_id'      => 'required|exists:biens,id',
            'client_id'    => 'required|exists:users,id',
            'date_debut'   => 'required|date',
            'date_fin'     => 'required|date|after:date_debut',
            'loyer_mensuel'=> 'required|numeric|min:0',
            'date_attribution' => 'CURRENT_DATE',
        ]);

        $validated['date_attribution'] = now()->toDateString();

        // Création de l’attribution
        $attribution = Attribution::create($validated);

        // Mettre le bien en statut "attribue" pour empecher plusieurs locataire de louer le meme bien dans la meme période
        $attribution->bien->update(['statut' => 'attribue']);

        // Notifications
        $attribution->client->notify(new AttributionCreee($attribution));
        $attribution->bien->proprietaire->notify(new AttributionCreee($attribution));

        return redirect()->route('admin.attributions.index')
            ->with('success', 'Attribution créée avec succès et notifications envoyées.');
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
