<?php

namespace App\Providers;

use App\Models\Attribution;
use App\Models\Paiement;
use App\Models\User;
use FedaPay\FedaPay;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */


    public function boot(): void
    {
        // Injecte la liste des propriétaires dans le layout admin à chaque rendu
        View::composer('layouts.admin', function ($view) {
            $proprietaires = User::where('role', 'proprietaire')
                ->select('id','name', 'surname', 'email')
                ->orderBy('name')
                ->get();
            
            $paiements = Paiement::with('attribution.bien', 'attribution.client')
            ->orderBy('date_paiement', 'desc')
            ->get();

            $attributions = Attribution::with(['bien', 'client'])
            ->get();

            $view->with('proprietaires', $proprietaires)
                 ->with('attributions', $attributions);
        });


        View::composer('layouts.proprietaire', function($view) {
            $proprio = Auth::user();
            $view->with('proprio', $proprio);
        });


        View::composer('layouts.client', function ($view) {
            $client = Auth::user(); // récupère l’utilisateur connecté
            $view->with('client', $client); // injecte $client dans layouts.client
        });


        // Injecter les 10 derniers témoignages dans toutes les vues publiques
        View::composer('*', function ($view) {
            $temoignages = \App\Models\Temoignage::latest()->take(10)->get();
            $view->with('temoignages', $temoignages);
        });

        


        // Clé API test ou live
        \FedaPay\FedaPay::setApiKey(env('FEDAPAY_SECRET_KEY'));

        // Environnement: 'sandbox' ou 'live'
        \FedaPay\FedaPay::setEnvironment(env('FEDAPAY_ENV', 'sandbox'));
    }

}
