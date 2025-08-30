<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;
use App\Models\Paiement;

class PaiementEffectue extends Notification
{
    use Queueable;

    protected $paiement;

    public function __construct(Paiement $paiement)
    {
        $this->paiement = $paiement;
    }

    public function via($notifiable)
    {
        return ['database']; // On envoie via la base de données
    }

    public function toDatabase($notifiable)
    {
        return [
            'attribution_id' => $this->paiement->attribution_id,
            'client_name'    => $this->paiement->attribution->client->name ?? '—',
            'client_surname' => $this->paiement->attribution->client->surname ?? '',
            'bien_titre'     => $this->paiement->attribution->bien->titre ?? '—',
            'montant'        => $this->paiement->montant,
            'mode'           => $this->paiement->mode,
            'message'        => "💰 Paiement réussi : {$this->paiement->montant} FCFA de {$this->paiement->attribution->client->name} pour '{$this->paiement->attribution->bien->titre}'"
        ];
    }
}
