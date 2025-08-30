<?php

namespace App\Http\Controllers;

use App\Models\Bien;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'bien_id',
        'client_id',
        'feda_transaction_id',
        'montant',
        'status',
        'date_debut',
        'date_fin'
    ];

    // Relation avec le bien
    public function bien()
    {
        return $this->belongsTo(Bien::class);
    }

    // Relation avec le client
    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }
}

