<?php

namespace App\Notifications;

use App\Models\Attribution;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class AttributionRelancee extends Notification implements ShouldQueue
{
    use Queueable;

    protected $attribution;

    public function __construct(Attribution $attribution)
    {
        $this->attribution = $attribution;
    }

    public function via($notifiable)
    {
        return ['database']; 
    }

    public function toDatabase($notifiable)
    {
        return [
            'attribution_id' => $this->attribution->id,
            'bien'           => $this->attribution->bien->titre,
            'client'         => $this->attribution->client->name,
            'date_debut'     => $this->attribution->date_debut,
            'date_fin'       => $this->attribution->date_fin,
            'message'        => "L’attribution du bien « {$this->attribution->bien->titre} » a été relancée (du {$this->attribution->date_debut->format('d/m/Y')} au {$this->attribution->date_fin->format('d/m/Y')}).",
        ];
    }
}
