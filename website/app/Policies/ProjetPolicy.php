<?php

namespace App\Policies;

use App\Policies\GeneralPolicy;
use App\Projet;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Policy to protect actions linked to projects.
 */
class ProjetPolicy
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
     * @param projet: the project he want to see.
     * @return mixed
     */
    public function view(User $user, Projet $projet)
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
        return auth()->check()
            && ($user->role_id == 8 // respos
                || $user->role_id == 9
                || $user->role_id == 10
                || $user->role_id == 1 // président
                || $user->role_id == 2 // secrétaire
                || $user->role_id == 5 // respo comm
            );
    }

    /**
     * Determine whether the user can update the model.
     *
	 * @param user: the current user.
     * @param projet: the project he want to see.
     * @return mixed
     */
    public function update(User $user, Projet $projet)
    {
        return auth()->check() && ($user->id == $projet->chef->id || $user->role_id == 5 || $user->role_id == 1);
    }

    /**
     * Determine whether the user can delete the model.
     *
	 * @param user: the current user.
     * @param projet: the project he want to see.
     * @return mixed
     */
    public function delete(User $user, Projet $projet)
    {
        return auth()->check() && ($user->id == $projet->chef->id || GeneralPolicy::checkAdmin() || $user->id == $projet->pole->respo_id);
    }

}