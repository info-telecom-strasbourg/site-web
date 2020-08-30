<?php

namespace App\Policies;

use App\Policies\GeneralPolicy;
use App\Pole;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Policy to protect actions linked to poles.
 */
class PolePolicy
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
     * @param pole: the pole he want to see.
     * @return mixed
     */
    public function view(User $user, Pole $pole)
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
		//
    }

    /**
     * Determine whether the user can update the model.
     *
	 * @param user: the current user.
     * @param pole: the pole he want to see.
     * @return mixed
     */
    public function update(User $user, Pole $pole)
    {
		return auth()->check() && ($user->id == $pole->respo->id || GeneralPolicy::checkAdmin());
    }

    /**
     * Determine whether the user can delete the model.
     *
	 * @param user: the current user.
     * @param pole: the pole he want to see.
     * @return mixed
     */
    public function delete(User $user, Pole $pole)
    {
        //
    }

}
