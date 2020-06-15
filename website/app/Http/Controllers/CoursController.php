<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Cours;

use App\Reference;

use Illuminate\Http\UploadedFile;

use Illuminate\Support\Facades\Storage;

class CoursController extends Controller
{
	/**
	 * Get all the lessons
	 */
	public function index(Cours $cours)
	{
		return Cours::all();
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
			$pos = 0;
			foreach ($request->link_support as $file)
			{
				$path = Storage::putFile('supports', $file, 'private');
				$name = $file->getClientOriginalName();
				Reference::create([ 'ref' => $path,
					'visibility' => array_key_exists($name, $request->visibility),
					'name' => $name,
					'cours_id' => $cours->id
				]);
			}
		}
		return redirect('/cours');
	}

	public function edit(Cours $cours)
	{
		return view('cours.edit',compact('cours'));
	}

	public function update(Cours $cours)
	{
		$cours->update(validateCours());
		return redirect('/cours');
	}

	public function destroy()
	{

	}

	public function  validateCours ()
	{
		return request()->validate([
			'title' => 'required',
			'desc' => 'required',
		]);;
	}
}
