<?php

namespace App\Policies;

use App\Cours;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Policy to protect actions linked to lessons.
 */
class CoursPolicy
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
     * @param cours: the lesson he want to see.
     * @return mixed
     */
    public function view(User $user, Cours $cours)
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
		return auth()->check();
    }

    /**
     * Determine whether the user can update the model.
     *
	 * @param user: the current user.
     * @param cours: the lesson he want to update.
     * @return mixed
     */
    public function update(User $user, Cours $cours)
    {
        if (!auth()->check())
            return false;

		foreach ($cours->creators as $creator)
		{
        	if ($creator->id == $user->id)
				return true;
        }

        // if the loged in user is the respo support
        if ($user->role_id == 4)
            return true;

		return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
	 * @param user: the current user.
     * @param cours: the lesson he want to delete.
     * @return mixed
     */
    public function delete(User $user, Cours $cours)
    {
        //
    }

}
