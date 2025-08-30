<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class LoyerMensuel extends Notification
{
    use Queueable;

    protected $attribution;

    public function __construct($attribution)
    {
        $this->attribution = $attribution;
    }

    public function via($notifiable)
    {
        return ['mail']; // ou ['database','mail'] si tu veux en DB aussi
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Rappel : paiement du loyer')
                    ->greeting('Bonjour '.$notifiable->name.',')
                    ->line('Il est temps de recevoir le loyer du bien : '.$this->attribution->bien->titre)
                    ->line('Montant à payer : '.number_format($this->attribution->loyer_mensuel, 0, ',', ' ').' FCFA')
                    ->line('Date de début de contrat : '.$this->attribution->date_debut->format('d/m/Y'))
                    ->line('Merci de vérifier et de procéder au paiement.');
    }
}
