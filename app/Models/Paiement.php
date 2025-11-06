<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;

    protected $fillable = [
        'attribution_id', 'montant', 'date_paiement', 'mode', 'status_paiement'
    ];

    protected $casts = [
        'date_paiement' => 'date',
    ];

    // Paiement → Attribution
    public function attribution()
    {
        return $this->belongsTo(Attribution::class);
    }

}

