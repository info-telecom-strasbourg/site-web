<?php

namespace App\Policies;

use App\Pole;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PolePolicy
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
     * @param  \App\Cours  $cours
     * @return mixed
     */
    public function view(User $user, Cours $cours)
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
		//
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Cours  $cours
     * @return mixed
     */
    public function update(User $user, Pole $pole)
    {
		return auth()->check() && $user->id == $pole->respo->id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Cours  $cours
     * @return mixed
     */
    public function delete(User $user, Cours $cours)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Cours  $cours
     * @return mixed
     */
    public function restore(User $user, Cours $cours)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Cours  $cours
     * @return mixed
     */
    public function forceDelete(User $user, Cours $cours)
    {
        //
    }
}
