<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pole extends Model
{
    protected $guarded = [];

    public function respo()
    {
        return $this->belongsTo(User::class);
    }

    public function projets()
    {
        return $this->hasMany(Projet::class);
    }
}
