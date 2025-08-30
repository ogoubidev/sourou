<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Attribution;
use App\Notifications\LoyerMensuel;
use Carbon\Carbon;

class EnvoyerLoyerMensuel extends Command
{
    protected $signature = 'loyer:envoyer';
    protected $description = 'Envoyer une notification au propriétaire pour le paiement du loyer mensuel';

    public function handle()
    {
        $today = Carbon::today();

        // On récupère les attributions actives pour lesquelles c'est le jour de loyer
        $attributions = Attribution::with('bien.proprietaire')
                          ->where('date_fin', '>=', now())
                          ->get();

        foreach ($attributions as $attr) {
            if ($attr->date_debut && $attr->date_fin) {
                // On vérifie si aujourd'hui correspond à la date du mois pour envoyer le rappel
                $start = $attr->date_debut;
                $monthsPassed = $start->diffInMonths($today);
                $nextDue = $start->copy()->addMonths($monthsPassed);

                if ($nextDue->isSameDay($today)) {
                    $attr->bien->proprietaire->notify(new LoyerMensuel($attr));
                    $this->info("Notification envoyée pour le bien {$attr->bien->titre}");
                }
            }
        }

        $this->info('Toutes les notifications ont été envoyées.');
    }
}
