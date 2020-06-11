<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Cours;

class CoursController extends Controller
{
	public function index(Cours $cours)
	{
		return Cours::all();
	}

	public function show(Cours $cours)
	{
		return view('poles.cours.cours', compact('cours'));
	}

	public function create()
	{

	}

	public function store()
	{

	}

	public function edit(Cours $cours)
	{

	}

	public function update(Cours $cours)
	{

	}

	public function destroy()
	{

	}
}
