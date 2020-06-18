<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Competition;

use App\Pole;

class CompetitionController extends Controller
{
	/**
	 * List all the competitions
	 */
    public function index()
	{
		return view('poles.competitions.index', [ 'compets' => Competition::all(), 'pole' => Pole::where('title', 'Compétition')->first() ]);
	}

	/**
	 * Show a competition
	 */
	public function show(Competition $compet)
	{
		return view('poles.competition.show', compact('compet'));
	}

	/**
	 * Return view to create a competition
	 */
	public function create()
	{
		return view('poles.competitions.create');
	}

	/**
	 * Store a new lesson
	 */
	public function store()
	{
		$validation = $this->validateCompetiton();
		dd('OK');
		Competition::create($this->validateCompetiton());
		return redirect('poles.competition.index');
	}

	public function edit(Competition $compet)
	{
		redirect('poles.competition.edit', compact('compet'));
	}

	public function update(Cours $cours)
	{
		//TODO ce truc
	}

	public function destroy()
	{

	}

	public function  validateCompetiton ()
	{
		return request()->validate([
			'id' => 'required',
			'title' => 'required',
			'desc' => 'required',
			'date' => 'required',
			'images' => 'required',
			'website' => 'required',
		]);
	}
}
