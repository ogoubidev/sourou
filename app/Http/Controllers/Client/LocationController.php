<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Bien;
use App\Models\Location;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;


class LocationController extends Controller
{

    
    public function store(Request $request, $bienId)
    {
        $validator = Validator::make($request->all(), [
            'date_debut' => ['required', 'date', 'after_or_equal:today'],
            'date_fin'   => ['required', 'date', 'after:date_debut'],
        ]);
    
        if ($validator->fails()) {
            // Redirection avec tous les messages d'erreur
            return redirect()->back()
                             ->withErrors($validator)
                             ->withInput();
        }
    
        // Vérifier si le bien est disponible
        $bien = Bien::findOrFail($bienId);
        if ($bien->statut === 'attribue') {
            return redirect()->back()->with('error', 'Ce bien n’est plus disponible.');
        }
    
        // Créer la location
        Location::create([
            'bien_id'    => $bienId,
            'user_id'    => auth()->id(),
            'date_debut' => $request->date_debut,
            'date_fin'   => $request->date_fin,
        ]);
    
        return redirect()->back()->with('success', 'Votre demande de location a été enregistrée !');
    }
    
}


