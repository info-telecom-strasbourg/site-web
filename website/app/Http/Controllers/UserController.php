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
        $users = User::orderByRaw('name')->paginate(20);
        $roles = Role::all();
        $all_users = User::all();
        return view('users.index', compact('users', 'roles', 'all_users'));
    }
}
