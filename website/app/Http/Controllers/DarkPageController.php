<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Projet;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DarkPageController extends Controller
{
	/**
	* Get the ressources required for the admin page.
	*
	* @return the admin page.
	*/
    public function getRessources()
	{
		$users = User::all();
		$roles = Role::all();
		$projets = Projet::all();
		return view('dark-page', ['users' => $users, 'roles' => $roles, 'projets' => $projets]);
	}

	/**
	 * Delete a user. If this user is the chief of a project,
	 * he can not be deleted.
	 * Verifier pour le chef
	 *
	 * @param user: the user that you want to delete.
	 * @return the view of the admin-page.
	 */
	public function deleteUser(User $user)
	{
		$projets = $user->projets;
		foreach ($projets as $key => $value) {
			if ($value->chef_projet_id == $user->id)
				return back()->with('erreur', 'Vous ne pouvez pas supprimer un utilisateur qui est chef d\'un projet');
		}
		if(substr($user->profil_picture, 0, 24) != "images/defaut/profil.jpg")
			unlink(storage_path('app/public/' . $user->profil_picture));
		if($user->cours() != null)
			$user->cours()->detach();
		if($user->projets() != null)
			$user->projets()->detach();
		$user->delete();
		return redirect('/page-admin');
	}

	/**
	 * Update a user profil.
	 *
	 * @param user: the user that will be updated.
	 * @return the view of the admin page.
	 */
	public function updateUser(User $user, Request $request)
	{
		$validatedRequest = $this->validator($request->all())->validate();
		$user->update(['name' => $validatedRequest['name'], 'email' => $validatedRequest['email']]);
		if(array_key_exists('password', $validatedRequest))
			$user->update(['password' => Hash::make($validatedRequest['password'])]);

		if(array_key_exists('image_profile', $validatedRequest))
		{
			if(substr($user->profil_picture, 0, 24) != "images/defaut/profil.jpg")
				unlink(storage_path('app/public/' . $user->profil_picture));
			$user->update(['profil_picture' => $validatedRequest['image_profile']]);
		}
		return redirect('/page-admin');
	}

	/**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        // create validator
        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role' => ['required', 'integer'],
            'password' => ['string', 'min:8', 'confirmed'],
        ]);

        /*
         * perform further validation after validation is completed
         * check if a user with a role that belongs to the Bureau or Respo
         * is not created twice
         */
        $validator->after(function ($validator) use ($data) {
            $selectRole = Role::where('id', $data['role'])->first();

            if (!is_object($selectRole))
                return $validator;

            if ($selectRole->is_unique == 1)
                return back()->with('erreur', 'Vous ne pouvez pas créer un nouveau ' . strtolower($selectRole->role) . '.');
        });

        return $validator;
    }
}
