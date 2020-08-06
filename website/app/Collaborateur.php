<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Model for collaborators.
 */
class Collaborateur extends Model
{
	/**
	 * Get the projects of a partner.
	 */
    public function projets()
    {
        return $this->hasMany(Projet::class);
    }
}
