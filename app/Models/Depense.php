<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depense extends Model
{
    use HasFactory;

    protected $fillable = [
        'bien_id',
        'type',
        'montant',
        'date_depense',
        'prestataire',
        'description',
    ];

    public function bien()
    {
        return $this->belongsTo(Bien::class);
    }
}
