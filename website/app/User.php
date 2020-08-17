<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Model for users.
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'role_id', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the projects of the user.
	 *
	 * @return the projects to wich the user participated.
     */
    public function projets()
    {
        return $this->belongsToMany(Projet::class);
    }


	/**
	 * Get the lessons the user created.
	 *
	 * @return all the lessons created by the user.
	 */
	public function cours()
	{
		$this->belongsToMany(Cours::class);
	}

    /**
     * Get the role of the user.
	 *
	 * @return the role of the user.
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    
    /**
     * Get the topics the user created.
	 *
	 * @return the the topics created by the user.
     */
    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    /**
     * Scope a query to only include researched users.
	 * If a search value has been specified, search if the a title or the
	 * description has this value otherwise return the query
     *
     * @param query: the user's query
     * @return all users that match the scope.
     */
    public function scopeSearch($query)
    {
        // get the roles id that matches the search query
        $role = Role::where('role', 'like', '%'.request()->search.'%')->get(['id']);

        return empty(request()->search) ? $query : $query->where('name', 'like', '%'.request()->search.'%')->orWhereIn('role_id', $role);
    }
}
