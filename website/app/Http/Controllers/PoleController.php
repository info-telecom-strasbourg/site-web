<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Pole;

class PoleController extends Controller
{
    /**
     * Display all poles.
     *
     * @return view with all poles available
     */
    public function index()
    {
        return Pole::all();
    }

    /**
     * Show a specified pole.
     *
     * @param App\Pole $pole: the pole you want to display
     * @return view of a specific lesson
     */
    public function show($pole)
    {
    $pole = Pole::where('title', str_replace('_', ' ', $pole))->first();
		if ($pole->specifique_display == 0)
        	return view('poles.show', compact('pole'));
		else
			return Redirect::back();
    }

    /**
     * Show the form to create a pole.
     *
     * @return view to create a pole
     */
    public function create()
    {

    }

    /**
     * Store a new pole.
     */
    public function store()
    {

    }

    /**
     * Show the form for editing the specified pole.
     *
     * @param App\Pole $pole: the pole you want to edit
     * @return view to edit the pole
     */
    public function edit(Pole $pole)
    {
		return view('poles.edit', compact('pole'));
    }

    /**
     * Update the specified pole.
     *
     * @param App\Pole $pole: the pole you want to update
     * @return redirect to the pole's specific page
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
     * Delete a pole and everything attached to it.
     */
    public function destroy()
    {

    }

}
