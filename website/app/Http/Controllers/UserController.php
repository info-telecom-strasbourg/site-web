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
        $users = User::orderBy('role_id')->orderBy('name')->get();
        $nbUsers = User::count();
        return view('users.index', compact('users', 'nbUsers'));
    }
}
