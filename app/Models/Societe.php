<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Societe extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'nom', 'contact', 'email', 'localisation'];

    public function factures()
    {
        return $this->hasMany(Facture::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function usagers()
    {
        return $this->hasMany(Usager::class);
    }

    public function accompagnateurs()
    {
        return $this->hasMany(Accompagnateur::class);
    }
}
