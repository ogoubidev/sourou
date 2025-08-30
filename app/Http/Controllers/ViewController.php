<?php

namespace App\Http\Controllers;

use App\Models\Bien;
use App\Models\Temoignage;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function accueil()
    {
        $temoignages = Temoignage::latest()->take(10)->get();
        return view('accueil', compact('temoignages'));
    }

    public function apropos()
    {
        return view('apropos');
    }

    // Méthode catalogue fusionnée
    public function catalogue(Request $request)
    {
        $query = $request->query('query');

        $biens = Bien::with('proprietaire')
            ->when($query, function($q) use ($query) {
                $q->where('titre', 'like', "%{$query}%");
            })
            ->get();

        return view('catalogue', compact('biens', 'query'));
    }

    public function contact()
    {
        return view('contact');
    }
}
