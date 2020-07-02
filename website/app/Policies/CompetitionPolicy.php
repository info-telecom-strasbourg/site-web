<?php

namespace App\Policies;

use App\Competition;
use App\User;
use App\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompetitionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Competition  $competition
     * @return mixed
     */
    public function view(User $user, Competition $competition)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {

		return auth()->check() && ($user->role_id == Role::where('role', 'Responsable compétition')->pluck('id')->first());
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Competition  $competition
     * @return mixed
     */
    public function update(User $user, Competition $competition)
    {
		return auth()->check() && $user->role_id == Role::where('role','Responsable compétition')->pluck('id');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Competition  $competition
     * @return mixed
     */
    public function delete(User $user, Competition $competition)
    {
		return auth()->check() && $user->role_id == Role::where('role','Responsable compétition')->pluck('id');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Competition  $competition
     * @return mixed
     */
    public function restore(User $user, Competition $competition)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Competition  $competition
     * @return mixed
     */
    public function forceDelete(User $user, Competition $competition)
    {
        //
    }
}
