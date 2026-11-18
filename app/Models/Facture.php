<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
     use HasFactory;

    protected $fillable = ['id','numero', 'date_paiement', 'montant', 'societe_id'];

    public function societe()
    {
        return $this->belongsTo(Societe::class);
    }

    public function details()
    {
        return $this->hasMany(Detail_Facture::class);
    }


}
