<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Zone;
use App\Models\Visite;

class Visiter_Zone extends Model
{
    protected $table = 'visiter__zones';
    protected $fillable = ['zone_id', 'visite_id'];

    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }

    public function visite()
    {
        return $this->belongsTo(Visite::class);
    }
}
