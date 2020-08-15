<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Projet;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class AdminMembresController extends Controller
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
        return view('page-admin/membres', ['users' => $users, 'roles' => $roles, 'projets' => $projets]);
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
        if (substr($user->profil_picture, 0, 32) != "images/default/profil/profil.jpg")
            unlink(storage_path('app/public/' . $user->profil_picture));
        if ($user->cours() != null)
            $user->cours()->detach();
        if ($user->projets() != null)
            $user->projets()->detach();
        $user->delete();
        return redirect('/page-admin/membres');
    }

    /**
     * Update a user profil.
     *
     * @param user: the user that will be updated.
     * @return the view of the admin page.
     */
    public function updateUser(User $user, Request $request)
    {
        $validatedRequest = $this->validator($request->all(), $user)->validate();

        $user->update(['name' => $validatedRequest['name'], 'email' => $validatedRequest['email'], 'role_id' => $validatedRequest['role']]);

        if ($validatedRequest['password'] != null)
            $user->update(['password' => Hash::make($validatedRequest['password'])]);


        if (array_key_exists('image_profile', $validatedRequest)) {
            if (file_exists(storage_path('app/public/' . $user->profil_picture)) && substr($user->profil_picture, 0, 32) != "images/default/profil/profil.jpg")
                unlink(storage_path('app/public/' . $user->profil_picture));
            $user->update(['profil_picture' => $this->saveImage($validatedRequest)]);
        }

        return redirect('/page-admin/membres');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @param user: the user that will be modified
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data, User $user)
    {
        // create validator
        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'role' => ['required', 'integer'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'image_profile' => ['nullable'],
        ]);

        return $validator;
    }

    /**
     * Save an image given by the user in the public storage folder.
     *
     * @param request: the request of the user.
     * @return the path to find the image.
     */
    public function saveImage(array $validatedRequest)
    {
        $path = Storage::putFile('public/images', $validatedRequest['image_profile'], 'private');
        return substr($path, 7);
    }
}
