<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	protected $guarded = [];

	/**
     * Get the users with this role.
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
