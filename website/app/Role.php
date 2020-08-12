<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Model for roles.
 */
class Role extends Model
{
	protected $guarded = [];

	/**
     * Get the users with this role.
	 *
	 * @return the users that have this role.
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
