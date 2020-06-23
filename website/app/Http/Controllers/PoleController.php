<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Pole;

class PoleController extends Controller
{
    public function index(Pole $pole)
    {
        return Pole::all();
    }

    public function show(Pole $pole)
    {
        return view('poles.show', compact('pole'));
    }

    public function create()
    {

    }

    public function store()
    {

    }

    public function edit()
    {

    }

    public function update()
    {

    }

    public function destroy()
    {

    }

}

//index
//show
//create
//
