<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Pole;

class PoleController extends Controller
{
    /**
     * Display all poles.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Pole::all();
    }

    /**
     * Show a specified pole.
     *
     * @param string $pole: the pole you want to display
     * @return \Illuminate\Http\Response
     */
    public function show($pole)
    {
        $pole = Pole::where('slug', $pole)->first();
        return view('poles.show', compact('pole'));
    }

    /**
     * Show the form to create a pole.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a new pole.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {

    }

    /**
     * Show the form for editing the specified pole.
     *
     * @param App\Pole $pole: the pole you want to edit
     * @return \Illuminate\Http\Response
     */
    public function edit(Pole $pole)
    {
		return view('poles.edit', compact('pole'));
    }

    /**
     * Update the specified pole.
     *
     * @param App\Pole $pole: the pole you want to update
     * @return \Illuminate\Http\Response to the pole's specific page
     */
    public function update(Pole $pole)
    {
		$pole->update(request()->validate([
			'title' => 'required',
			'desc' => 'required'
		]));

		return view('poles.show', compact('pole'));
    }

    /**
     * Delete a specific pole and everything attached to it.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {

    }

}
