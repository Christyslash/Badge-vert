<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ['id','libelle', 'societe_id'];

    public function details()
    {
        return $this->hasMany(Detail_Facture::class);
    }

    public function societe()
    {
        return $this->belongsTo(Societe::class);
    }

    public function accompagnateurs()
    {
        return $this->hasMany(Accompagnateur::class);
    }
}
