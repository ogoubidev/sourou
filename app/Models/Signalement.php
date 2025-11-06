<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Signalement extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'categorie',
        'description',
        'statut',
        'reponse_admin',
    ];

    /**
     * Relation avec le client
     */
    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }
}
