<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Model to get random projects.
 */
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
