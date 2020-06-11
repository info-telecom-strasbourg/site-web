<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pole extends Model
{
    protected $guarded = [];

	/* Return the responsible of the pole */
    public function respo()
    {
        return $this->belongsTo(User::class);
    }

	/* Return all the projects of the pole */
    public function projets()
    {
        return $this->hasMany(Projet::class);
    }
}
