<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Projet;
use App\Pole;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

/**
 * Controller linked to the member section of the admin page.
 */
class AdminMembresController extends Controller
{
    /**
     * Get the ressources required for the admin page.
     *
     * @return the admin page.
     */
    public function getRessources()
    {
        $users = User::search()->orderBy('role_id')->orderBy('name')->get();
        $roles = Role::all();
        $projets = Projet::all();
        $search = request()->search;
        return view('page-admin/membres', compact('users', 'roles', 'projets', 'search'));
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
        if ($user->role_id != 12)
            return back()->with('erreur', 'Vous ne pouvez pas supprimer un membre du CA');

        if (substr($user->profil_picture, 0, 24) != "images/profil/profil.jpg")
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
        $validatedRequest = $this->validator($request->all())->validate();

        $user->update(['name' => $validatedRequest['name'], 'email' => $validatedRequest['email'], 
        'role_id' => $validatedRequest['role'], 'class' => $validatedRequest['class'], 
        'year' => $validatedRequest['year']]);


        if ($user->role_id >= 8 && $user->role_id <= 11 || $user->role_id == 5)
        {
            if ($user->role_id == 8)
                $pole = Pole::where('slug', '=', 'competitions');
            elseif ($user->role_id == 9)
                $pole = Pole::where('slug', '=', 'programmation_utilitaire');
            elseif ($user->role_id == 10)
                $pole = Pole::where('slug', '=', 'applications_et_sites_web');
            elseif ($user->role_id == 11)
                $pole = Pole::where('slug', '=', 'jeux_videos');
            elseif ($user->role_id == 5)
                $pole = Pole::where('slug', '=', 'cours');
            
            $pole->update(['respo_id' => $user->id]);
        }

        if ($validatedRequest['password'] != null)
            $user->update(['password' => Hash::make($validatedRequest['password'])]);


        if (array_key_exists('image_profile', $validatedRequest)) {
            if (file_exists(storage_path('app/public/' . $user->profil_picture)) && substr($user->profil_picture, 0, 24) != "images/profil/profil.jpg")
                unlink(storage_path('app/public/' . $user->profil_picture));
            $user->update(['profil_picture' => $this->saveImage($validatedRequest)]);
        }

        return redirect('/page-admin/membres');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param data: the data that will be checked.
     * @return an array corresponding to the validated datas.
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255|min:3',
            'email' => 'required|string|email|max:255',
            'role' => 'required|integer',
            'password' => 'nullable|string|min:8|confirmed',
            'image_profile' => 'nullable',
			'class' => 'required|min:1',
			'year' => 'required|min:4|max:4',
        ]);
    }

    /**
     * Save an image given by the user in the public storage folder.
     *
     * @param request: the request of the user.
     * @return the path to find the image.
     */
    public function saveImage(array $validatedRequest)
    {
        $path = Storage::putFile('public/images/profil', $validatedRequest['image_profile'], 'private');
        return substr($path, 7);
    }
}
