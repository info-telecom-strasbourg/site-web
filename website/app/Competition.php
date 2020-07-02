<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
	protected $guarded = [];
	public $timestamps = false;
	
	/**
	 * Get the competitors.
	 */
	public function competitors()
    {
        return $this->belongsToMany(User::class, 'user_compet');
    }


}
