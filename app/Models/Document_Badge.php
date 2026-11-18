<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document_Badge extends Model
{
    protected $table = 'document__badges';

    protected $fillable = ['fichier', 'badge_id', 'document_id'];

    public function badge()
    {
        return $this->belongsTo(Badge::class);
    }

    public function document()
    {
        return $this->belongsTo(Document::class);
    }
}

