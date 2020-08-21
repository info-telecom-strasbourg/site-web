<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pole;

/**
 * Controller linked to the poles.
 */
class PoleController extends Controller
{
    /**
     * Get all poles.
     *
     * @return all the poles
     */
    public function index()
    {
        return Pole::all();
    }

    /**
     * Show a specified pole.
     *
     * @param pole: the pole's name that you want to display
     * @return the pole's view
     */
    public function show($pole)
    {
        $pole = Pole::where('slug', $pole)->first();
        return view('poles.show', compact('pole'));
    }

    /**
     * Show the form to create a pole.
     *
     * @return the view to create a pole.
     */
    public function create()
    {
		//TODO just in case
    }

    /**
     * Store a new pole.
     *
     * @return redirect to.....
     */
    public function store()
    {
		//TODO just in case
    }

    /**
     * Show the form for editing the specified pole.
     *
     * @param pole: the pole you want to edit.
     * @return the view to edit the pole.
     */
    public function edit(Pole $pole)
    {
        $this->authorize('update', $pole);
		return view('poles.edit', compact('pole'));
    }

    /**
     * Update the specified pole.
     *
     * @param pole: the pole you want to update
     * @return the pole's specific page
     */
    public function update(Pole $pole)
    {
        $this->authorize('update', $pole);
        $pole->update(request()->validate([
          'title' => 'required',
          'desc' => 'required'
        ]));

        return view('poles.show', compact('pole'));
    }

    /**
     * Delete a specific pole and everything attached to it.
     *
     * @return redirect to.....
     */
    public function destroy(Pole $pole)
    {
      //TODO ???
      
      // delete the associate comments
      foreach ($pole->comments as $comment) {
        foreach ($comment->comments as $replyComment)
            $replyComment->delete();
        $comment->delete();
      }
    }

}
