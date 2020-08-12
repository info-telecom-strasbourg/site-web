<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Controller for Homepage.
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return the home view
     */
    public function index()
    {
        return view('home');
    }
}
