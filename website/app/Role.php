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

	/**
     * Indicate if a role can be given.
     *
     * @return a boolean that indicate if the role can be given.
     */
    public function isAvailable()
    {
        $usedBy = $this->users()->count();
        return ($this->is_unique == 0 || $usedBy == 0);
    }
}
