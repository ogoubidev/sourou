<?php

// app/Events/PaiementCree.php
namespace App\Events;

use App\Models\Paiement;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class PaiementCree implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $paiement;

    public function __construct(Paiement $paiement)
    {
        $this->paiement = $paiement->load('attribution');
    }

    public function broadcastOn()
    {
        return new PrivateChannel('attribution.'.$this->paiement->attribution_id);
    }

    public function broadcastAs()
    {
        return 'paiement.cree';
    }
}
