<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visite extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'code_visite',
        'date_debut',
        'date_fin',
        'heure_debut',
        'heure_fin',
        'objet',
        'etat_visite',
        'description',
        'accompagnateur_id',
        'usager_id'
    ];

    public function usager()
    {
        return $this->belongsTo(Usager::class);
    }

    public function accompagnateur()
    {
        return $this->belongsTo(Accompagnateur::class);
    }

    public function zones()
    {
        return $this->belongsToMany(Zone::class, 'visiter__zones', 'visite_id', 'zone_id')
                    ->withTimestamps();
    }


}
