<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use App\Projet;
use App\Cours;
use App\Competition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;



/**
 * Controller linked to users.
 */
class UserController extends Controller
{
    /**
     * Display a listing of the users.
     *
     * @return the users' index view
     */
    public function index()
    {
        $users = User::search()->orderBy('role_id')->orderBy('name')->get();
        $nbUsers = User::count();
        $search = request()->search;
        return view('users.index', compact('users', 'nbUsers', 'search'));
    }



    /**
     * Display a user's page.
     *
     * @return the user's view
     */
    public function show(User $user)
    {
        $projects = $user->projets;
        $lessons = $user->cours;
        $competitions = $user->competitions;
        $search = ['', '', ''];

        return view('users.show', compact('user', 'projects', 'lessons', 'competitions', 'search'));
    }

    /**
     * Search projet
     *
     * @return the user's view
     */
    public function search(User $user)
    {
        $projects = $user->projets()->where('title', 'like', '%'.request('search-projet').'%')->get();

        $lessons = $user->cours()->where('title', 'like', '%'.request('search-cours').'%')->get();

        $competitions = $user->competitions()->where('title', 'like', '%'.request('search-compet').'%')->get();

        $search = [
            request('search-projet'), 
            request('search-cours'), 
            request('search-compet')];

        return view('users.show', compact('user', 'projects', 'lessons', 'competitions', 'search'));
    }


    /**
     * Update a user profil.
     *
     * @param user: the user that will be updated.
     * @return the view of the profil page.
     */
    public function update(User $user)
    {
        $validatedRequest = $this->validateUser();

        $user->update([
            'name' => $validatedRequest['name'], 
            'email' => $validatedRequest['email'], 
            'class' => $validatedRequest['class'], 
            'year' => $validatedRequest['year']]);

        if ($validatedRequest['password'] != null)
            $user->update(['password' => Hash::make($validatedRequest['password'])]);


        if (array_key_exists('image_profile', $validatedRequest)) {
            if (file_exists(storage_path('app/public/' . $user->profil_picture)) && substr($user->profil_picture, 0, 32) != "images/default/profil/profil.jpg")
                unlink(storage_path('app/public/' . $user->profil_picture));
            $user->update(['profil_picture' => $this->saveImage($validatedRequest)]);
        }

        return back()->with('success','Vous avez bien mis à jour vos informations de profil.');;
    }

    /**
     * Update the profil picutre of the user.
     * 
     * @param user: the user for which the profil picture will be updated.
     * @return the view of the profil page.
     */
    public function update_avatar(User $user) {

        request()->validate([
            'profil_picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if (file_exists(storage_path('app/public/' . $user->profil_picture)) && substr($user->profil_picture, 0, 32) != "images/default/profil/profil.jpg")
            unlink(storage_path('app/public/' . $user->profil_picture));
        $user->update(['profil_picture' => $this->saveImage(request())]);

        return back()
            ->with('success','Vous avez bien mis à jour votre image de profil.');

    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validateUser()
    {
        return request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'class' => ['required', 'string', 'max:255'],
            'year' => ['required', 'string', 'max:4'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Save an image given by the user in the public storage folder.
     *
     * @param request: the request of the user.
     * @return the path to find the image.
     */
    public function saveImage(Request $request)
    {
        $path = Storage::putFile('public/images/profil', $request->profil_picture, 'private');
        return substr($path, 7);
    }
}
