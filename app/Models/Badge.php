<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'code',
        'statut',
        'date_edition',
        'couleur',
        'date_expiration',
        'usager_id'
    ];

    public function usager()
    {
        return $this->belongsTo(Usager::class);
    }

    public function documents()
    {
        return $this->belongsToMany(Document::class, 'document__badge')
                    ->withPivot('libelle', 'fichier')
                    ->withTimestamps();
    }
}
