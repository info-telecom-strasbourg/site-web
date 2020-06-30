<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	protected $guarded = [];

	/**
	 * Roles that can be mass asigned.
	 */
	private static $massRoles = ['Membre'];

	/**
     * Get the users with this role.
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get the number of roles that need to be unique.
     */
    public static function getMassRoles()
    {
    	return self::$massRoles;
    }
}
