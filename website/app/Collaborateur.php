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
	 *
	 * @return the projects linked to the collaborators.
	 */
    public function projets()
    {
        return $this->hasMany(Projet::class);
    }
}
