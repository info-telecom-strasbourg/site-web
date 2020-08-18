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
        'name', 'email', 'class', 'year', 'role_id', 'password', 'profil_picture'
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
        return $this->belongsToMany(Projet::class, 'projets_participants');
    }


	/**
	 * Get the lessons of the user.
	 *
	 * @return all the lessons created by the user.
	 */
	public function cours()
	{
		return $this->belongsToMany(Cours::class, 'cours_createurs');
    }
    
    /**
	 * Get the competitions of the user.
	 *
	 * @return all the competitions that the user attends.
	 */
	public function competitions()
	{
		return $this->belongsToMany(Competition::class, 'user_compet');
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
