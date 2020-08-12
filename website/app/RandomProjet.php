<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RandomProjet extends Model
{
    protected $guarded = [];

    /**
     * Gets the associate project.
     */
    public function projet()
    {
        return $this->belongsTo(Projet::class);
    }
}
