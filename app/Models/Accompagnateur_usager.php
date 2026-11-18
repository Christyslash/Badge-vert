<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccompagnateurUsager extends Model
{
    use HasFactory;

    protected $table = 'accompagnateur_usagers';

    protected $fillable = [
        'accompagnateur_id',
        'usager_id'
    ];

    //public $timestamps = false; // pivot n’a généralement pas de timestamps

    public function accompagnateur()
    {
        return $this->belongsTo(Accompagnateur::class);
    }

    public function usager()
    {
        return $this->belongsTo(Usager::class);
    }
}
