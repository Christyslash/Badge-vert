<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Accompagnateur extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'nom', 'prenoms', 'contact', 'email','numero_badge','societe_id','service_id'];

    public function societe()
    {
        return $this->belongsTo(Societe::class);
    }
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function visites()
    {
        return $this->hasMany(Visite::class);
    }


public function usagers()
{
    return $this->belongsToMany(Usager::class, 'accompagnateur_usagers', 'accompagnateur_id', 'usager_id');
}


}
