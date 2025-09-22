<?php

namespace App\Notifications;

use App\Models\Attribution;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AttributionCreee extends Notification implements ShouldQueue
{
    use Queueable;

    protected $attribution;

    /**
     * Crée une nouvelle instance de notification.
     */
    public function __construct(Attribution $attribution)
    {
        $this->attribution = $attribution;
    }

    /**
     * Canaux de notification (mail + base de données).
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Contenu du mail.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Nouvelle attribution immobilière')
            ->greeting('Bonjour ' . $notifiable->name)
            ->line("Une nouvelle attribution vous concerne :")
            ->line("Bien : " . $this->attribution->bien->titre)
            ->line("Client : " . $this->attribution->client->name)
            ->line("Date début : " . $this->attribution->date_debut->format('d/m/Y'))
            ->line("Date fin : " . $this->attribution->date_fin->format('d/m/Y'))
            ->line("Loyer mensuel : " . number_format($this->attribution->loyer_mensuel, 0, ',', ' ') . " FCFA")
            ->action('Voir l’attribution', url('/admin/attributions/' . $this->attribution->id))
            ->line('SOUROU IMMOBILIER vous remercie pour votre fidélité.');
    }

    /**
     * Contenu enregistré en base (dashboard Laravel).
     */
    public function toDatabase($notifiable)
    {
        return [
            'attribution_id' => $this->attribution->id,
            'bien'           => $this->attribution->bien->titre,
            'client'         => $this->attribution->client->name,
            'date_debut'     => $this->attribution->date_debut,
            'date_fin'       => $this->attribution->date_fin,
            'loyer'          => $this->attribution->loyer_mensuel,
            'message'        => "Nouvelle attribution du bien « " 
                                . $this->attribution->bien->titre 
                                . " » au client " 
                                . $this->attribution->client->name 
                                . ' '
                                . $this->attribution->client->surname
        ];
    }
}
