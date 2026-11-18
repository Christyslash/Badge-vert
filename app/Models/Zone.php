<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
     use HasFactory;

    protected $fillable = ['id','code','libelle'];

    public function visites()
    {
        return $this->belongsToMany(Visite::class, 'visiter__zones', 'visite_id', 'zone_id')
                    ->withTimestamps();
    }
}
