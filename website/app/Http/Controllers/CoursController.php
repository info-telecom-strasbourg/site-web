<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Cours;

use App\Support;

use App\Pole;

use Illuminate\Http\UploadedFile;

use Illuminate\Support\Facades\Storage;

class CoursController extends Controller
{
	/**
	 * Get all the lessons
	 */
	public function index()
	{
		$pole = Pole::where('title', 'Cours')->first();
		$cours = Cours::all();
		return view('poles.cours.index', ['cours' => $cours, 'pole' => $pole]);
	}

	public function show(Cours $cours)
	{
		return view('poles.cours.show', compact('cours'));
	}

	/**
	 * Return view to create a lesson
	 */
	public function create()
	{
		return view('poles.cours.create');
	}

	/**
	 * Store a new lesson
	 */
	public function store(Request $request)
	{
		$cours = Cours::create($this->validateCours());

		if ($request->has('link_support'))
		{
			foreach ($request->link_support as $file)
			{
				$path = Storage::putFile('supports', $file, 'private');
				$name = $file->getClientOriginalName();
				Support::create([ 'ref' => $path,
					'visibility' => ($request->has('visibility')) ? array_key_exists($name, $request->visibility) : 0,
					'name' => $name,
					'cours_id' => $cours->id
				]);
			}
		}
		return redirect('/poles/cours');
	}

	public function edit(Cours $cours)
	{
		return view('poles.cours.edit',compact('cours'));
	}

	public function update(Cours $cours)
	{
		$cours->update(validateCours());

		return redirect('/poles/cours');
	}

	public function destroy()
	{

	}

	public function  validateCours ()
	{
		return request()->validate([
			'title' => 'required',
			'desc' => 'required',
		]);
	}

	public function downloadFile ($id)
	{
		$supp = Support::where('id', $id)->first();
		return Storage::download($supp->ref, $supp->name);
	}
}
