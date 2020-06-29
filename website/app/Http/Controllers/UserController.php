<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::search()->orderBy('role_id')->orderBy('name')->get();
        $nbUsers = User::count();
        $search = request()->search;
        return view('users.index', compact('users', 'nbUsers', 'search'));
    }

    /**
     * Display a user.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

}
