<?php

namespace App\Http\Controllers;

use App\Models\Bien;
use App\Models\Post;
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
        $this->synchroniserBiens();
    
        // Récupération des filtres
        $query      = $request->query('query');
        $categorie  = $request->query('categorie');
        $type       = $request->query('type');
        $etat       = $request->query('etat');
    
        // Requête de base : exclure les biens vendus
        $biens = Bien::with(['proprietaire', 'attributions'])
            ->where('statut', '!=', 'vendu') // exclure les biens vendus
            ->when($query, function ($q) use ($query) {
                $q->where('titre', 'like', "%{$query}%");
            })
            ->when($categorie, function ($q) use ($categorie) {
                $q->where('categorie', $categorie);
            })
            ->when($type, function ($q) use ($type) {
                $q->where('type', $type);
            })
            ->when($etat, function ($q) use ($etat) {
                $q->where('etat', $etat);
            })
            ->get();
    
        return view('catalogue', compact('biens', 'query', 'categorie', 'type', 'etat'));
    }
    
    

    public function contact()
    {
        return view('contact');
    }

    public function gestion()
    {
        return view('gestion');
    }

    public function faq() 
    {
        return view('faq');
    }

    public function actualite()
    {
        // $posts = Post::all();
        $posts = Post::where('publie', true)->latest()->paginate(6);
        $recentPosts = Post::where('publie', true)->latest()->take(5)->get();

        return view('actualite', compact('posts', 'recentPosts'));
    }

    public function services()
    {
        return view('services');
    }

    public function partenaire()
    {
        return view('nospartenaire');
    }

    //Petite fonction de synchro locale
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
}
