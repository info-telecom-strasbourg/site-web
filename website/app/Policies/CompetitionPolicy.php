<?php

namespace App\Policies;

use App\Competition;
use App\User;
use App\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Policy to protect actions linked to competitions.
 */
class CompetitionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param user: the current user.
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param user: the current user.
     * @param competition: the competition he want to see.
     * @return mixed
     */
    public function view(User $user, Competition $competition)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param user: the current user.
     * @return mixed
     */
    public function create(User $user)
    {
		return auth()->check() && ($user->role_id == Role::where('role', 'Responsable compétitions')->pluck('id')->first());
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param user: the current user.
     * @param competition: the competition he want to update.
     * @return mixed
     */
    public function update(User $user)
    {
		return auth()->check() && ($user->role_id == Role::where('role','Responsable compétitions')->pluck('id')->first());
    }

    /**
     * Determine whether the user can delete the model.
     *
	 * @param user: the current user.
     * @param competition: the competition he want to delete.
     * @return mixed
     */
    public function delete(User $user, Competition $competition)
    {
		return auth()->check() && ($user->role_id == Role::where('role','Responsable compétitions')->pluck('id')->first());
    }

}
