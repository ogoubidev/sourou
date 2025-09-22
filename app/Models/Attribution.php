<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribution extends Model
{
    use HasFactory;

    protected $fillable = [
        'bien_id', 'client_id', 'date_attribution', 'date_debut', 'date_fin', 'loyer_mensuel', 'statut_paiement', 'mois_total'
    ];
    

    protected $casts = [
        'date_debut'       => 'date',
        'date_fin'         => 'date',
        'date_attribution' => 'date',
    ];

    protected $appends = ['status'];


    public function getStatusAttribute()
    {
        $today = now()->startOfDay();
        if ($this->date_fin && $today->gte($this->date_fin->startOfDay())) return 'terminee';
        if ($this->date_debut && $today->lt($this->date_debut->startOfDay())) return 'à venir';
        return 'active';
    }

    
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

    

    public function moisTotal()
    {
        return $this->date_debut && $this->date_fin
            ? $this->date_debut->diffInMonths($this->date_fin) + 1
            : 1;
    }

    public function moisPayes()
    {
        return $this->paiements()->where('status_paiement', 'paye')->count();
    }

    public function estEntierementPaye()
    {
        return $this->moisPayes() >= $this->moisTotal();
    }

}

