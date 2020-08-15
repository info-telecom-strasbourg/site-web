<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Projet;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminVueEnsembleController extends Controller
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
        $nbProjets = Projet::count();
        $nbUsers = User::count();
        return view('page-admin/vue-ensemble', ['users' => $users, 'roles' => $roles, 'projets' => $projets, 'nbProjets' => $nbProjets, 'nbUsers' => $nbUsers]);
    }
}