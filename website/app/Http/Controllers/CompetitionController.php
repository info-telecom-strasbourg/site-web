<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Competition;

use App\Pole;

class CompetitionController extends Controller
{
	/**
	 * List all the competitions.
	 *
	 * @return \Illuminate\Http\Response
	 */
    public function index()
	{
		return view('poles.competitions.index', [ 'compets' => Competition::all(), 'pole' => Pole::where('title', 'compétitions')->first() ]);
	}

	/**
	 * Show a specified competition.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show(Competition $competition)
	{
		return view('poles.competitions.show', compact('compet'));
	}

	/**
	 * Show the form to create a competition.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$this->authorize('create', Competition::class);
		return view('poles.competitions.create');
	}

	/**
	 * Store a new competition.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$compet = Competition::create($this->validateCompetiton());
		$competImage = [];

		foreach ($request->dates_comp as $key => $value)
		{
			$newDate = Date::create([
				'presentiel' => 1,
				'date' => $value
			]);
			$compet->dates()->attach($newDate->id);
		}
		return redirect('/poles/competitions/index');
	}

	/**
	 * Show the form for editing the specified competition.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Competition $compet)
	{
		return view('poles.competitions.edit', compact('compet'));
	}

	/**
	 * Update the specified competition.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update(Competition $compet)
	{
		//TODO ce truc
	}

	/**
	 * Remove the specified lesson.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy()
	{

	}

	/**
	 * Validate parameters.
	 */
	public function  validateCompetiton ()
	{
		return request()->validate([
			'title' => 'required',
			'desc' => 'required',
			'website' => 'required',
		]);
	}
}
