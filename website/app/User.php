<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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
     */
    public function projets()
    {
        return $this->belongsToMany(Projet::class);
    }


	/**
	 * Get the lessons of the user.
	 */
	public function cours()
	{
		$this->belongsToMany(Cours::class);
	}

    /**
     * Get the role of the user.
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Scope a query to only include researched users.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query)
    {
        // get the roles id that matches the search query
        $role = Role::where('role', 'like', '%'.request()->search.'%')->get(['id']);

        // if a search value has been specified, search if the a title or the
        // description has this value
        // otherwise return the query
        return empty(request()->search) ? $query : $query->where('name', 'like', '%'.request()->search.'%')->orWhereIn('role_id', $role);
    }
}
