<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'bien_id',
        'user_id',
        'date_debut',
        'date_fin',
        'statut',
    ];


        protected $casts = [
            'date_debut' => 'datetime',
            'date_fin'   => 'datetime',
        ];

    // 🔹 Chaque location appartient à un bien
    public function bien()
    {
        return $this->belongsTo(Bien::class);
    }

    // 🔹 Chaque location appartient à un client (user)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
