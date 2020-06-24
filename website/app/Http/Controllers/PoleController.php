<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Pole;

class PoleController extends Controller
{
    public function index()
    {
        return Pole::all();
    }

    public function show($pole)
    {
		$pole = \DB::table('poles')->where('title', str_replace('_', ' ', $pole))->first();
		$pole = Pole::find($pole->id);
		if ($pole->specifique_display == 0)
        	return view('poles.show', compact('pole'));
		else
			return Redirect::back();
    }

    public function create()
    {

    }

    public function store()
    {

    }

    public function edit(Pole $pole)
    {
		return view('poles.edit', compact('pole'));
    }

    public function update(Pole $pole)
    {
		$pole->update(request()->validate([
			'title' => 'required',
			'desc' => 'required'
		]));

		return view('poles.show', compact('pole'));
    }

    public function destroy()
    {

    }

}
