<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribution extends Model
{
    use HasFactory;

    protected $fillable = [
        'bien_id', 'client_id', 'date_attribution', 'date_debut', 'date_fin', 'loyer_mensuel',
    ];

    protected $casts = [
        'date_debut'       => 'date',
        'date_fin'         => 'date',
        'date_attribution' => 'date',
    ];
    
    // Attribution → Bien
    public function bien()
    {
        return $this->belongsTo(Bien::class);
    }

    // Attribution → Client
    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    //  Attribution → Paiements
    public function paiements()
    {
        return $this->hasMany(Paiement::class);
    }
}

