<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use App\Projet;
use App\Cours;
use App\Competition;
use Illuminate\Http\Request;

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
        $projects = Projet::where('chef_projet_id', $user->id)->get();
        $lessons = Cours::join('cours_createurs', 'cours_createurs.cours_id', 'cours.id')
              ->join('users', 'role_id', 'cours_createurs.user_id')
              ->where('role_id', $user->id)
              ->get();
        $competitions = Competition::join('user_compet', 'user_compet.competition_id', 'competitions.id')
                      ->join('users', 'role_id', 'user_compet.user_id')
                      ->where('role_id', $user->id)
                      ->get();
        return view('users.show', compact('user', 'projects', 'lessons', 'competitions'));
    }

}
