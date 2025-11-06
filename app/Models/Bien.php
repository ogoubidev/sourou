<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bien extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'description',
        'adresse',
        'prix',
        'type',        // vente ou location
        'statut',      // disponible / attribué
        'image',
        'categorie',   // maisons, appartements, terrain, vehicules, mobilier
        'etat',        // baties, inachevees, meuble, non_meuble
        'proprietaire_id'
    ];

    // 🔹 Chaque bien appartient à un propriétaire
    public function proprietaire()
    {
        return $this->belongsTo(User::class, 'proprietaire_id');
    }

    // 🔹 Un bien peut être attribué à un client
    public function attributions()
    {
        return $this->hasMany(Attribution::class);
    }

    public function medias()
    {
        return $this->hasMany(BienMedia::class);
    }

    // 🔹 Un bien peut avoir plusieurs locations (demandes)
    public function locations()
    {
        return $this->hasMany(Location::class);
    }
}
