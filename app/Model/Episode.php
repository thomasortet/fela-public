<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    protected $fillable = [
        'titre',
        'presentateur_id',
        'numero_episode',
        'saison',
        'note_id',
        'lien',
        'lieu',
        'annee',
        'description',
        'commentaire'
    ];
    public $timestamps = false;

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function presentateur()
    {
        return $this->belongsToMany(Presentateur::class);
    }
}
