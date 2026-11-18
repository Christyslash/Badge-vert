<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usager extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nom',
        'prenoms',
        'contact',
        'email',
        'objet',
        'photo',
        'date_debut',
        'date_fin',
        'statut_usager',
        'societe_id'
    ];

    public function badges()
    {
        return $this->hasMany(Badge::class);
    }

    public function visites()
    {
        return $this->hasMany(Visite::class);
    }

    public function societe()
    {
        return $this->belongsTo(Societe::class);
    }

    public function accompagnateurs()
{
    return $this->belongsToMany(Accompagnateur::class, 'accompagnateur_usagers', 'usager_id', 'accompagnateur_id');
}



}
