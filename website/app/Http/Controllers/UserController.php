<?php

namespace App\Http\Controllers;

use App\USer;
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
        $users = User::paginate(15);
        return view('users.index', compact('users'));
    }
}
