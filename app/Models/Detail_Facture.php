<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_Facture extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'fichier','montant', 'facture_id', 'service_id'];

    public function facture()
    {
        return $this->belongsTo(Facture::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }


}
