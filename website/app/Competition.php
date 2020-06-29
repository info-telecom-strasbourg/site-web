<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
	/**
	 * Get the competitors.
	 */
	public function competitors()
    {
        return $this->belongsToMany(User::class, 'user_compet');
    }


}
