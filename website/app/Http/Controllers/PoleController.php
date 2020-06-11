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

    public function edit(Pole $pole)
    {
		return view('poles.edit',compact('pole'));
    }

    public function update(Pole $pole)
    {
		$pole->update(request()->validate([
			'title' => 'required',
			'desc' => 'required',
		]));

		return redirect('/poles'.$pole->id);
    }

    public function destroy()
    {

    }

}
