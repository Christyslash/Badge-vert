<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'libelle'];

    public function badges()
    {
        return $this->belongsToMany(Badge::class, 'document__badge')
                    ->withPivot('libelle', 'fichier')
                    ->withTimestamps();
    }
}
