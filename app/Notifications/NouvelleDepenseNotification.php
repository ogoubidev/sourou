<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;


class NouvelleDepenseNotification extends Notification
{
    use Queueable;

    protected $depense;

    public function __construct($depense)
    {
        $this->depense = $depense;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'type' => 'depense',
            'message' => "Une nouvelle dépense a été enregistrée pour votre bien « {$this->depense->bien->nom} » : {$this->depense->type} ({$this->depense->montant} FCFA).",
            'depense_id' => $this->depense->id,
            'bien_id' => $this->depense->bien->id,
        ];
    }
}

