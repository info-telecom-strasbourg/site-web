<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cours;
use App\User;
use App\Support;
use App\Pole;
use App\Date;
use App\DatesCours;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

/**
 * Controller linked to the lessons.
 */
class CoursController extends Controller
{
	/**
	 * Display all lessons with associate pole and send them to the index view.
	 *
	 * @return the view with all the lessons.
	 */
	public function index()
	{
		$pole = Pole::where('slug', 'cours')->first();
		$lessons = Cours::orderBy('id', 'DESC')->get();
		return view('poles.cours.index', ['lessons' => $lessons, 'pole' => $pole]);
	}

	/**
	 * Show a specified lesson.
	 *
	 * @param cours: the lesson you want to display.
	 * @return the view corresponding to the lesson.
	 */
	public function show(Cours $cours)
	{
		return view('poles.cours.show', compact('cours'));
	}

	/**
	 * Show the form to create a lesson.
	 *
	 * @return the view to create the lesson.
	 */
	public function create()
	{
		$this->authorize('create', Cours::class);
		$users = User::all();
		return view('poles.cours.create', compact('users'));
	}

	/**
	 * Store a new lesson.
	 *
	 * @param request: the user request.
	 * @return redirect to the lesson's index page.
	 */
	public function store(Request $request)
	{
		$cours = Cours::create($this->validateCours());

		if ($request->has('link_support'))
		{
			foreach ($request->link_support as $file)
			{
				$name = $file->getClientOriginalName();
				$this->saveFile($file, $name, $cours, ($request->has('visibility')) ? array_key_exists($name, $request->visibility) : 0);
			}
		}

		if ($request->has('cover'))
			$cours->cover = $this->saveImage($request->cover);
		else
			$cours->cover = $this->selectDefaultImage();

		$cours->save();

		foreach ($request->creators as $creator)
			$cours->creators()->attach($creator);

		$this->saveDates($request, $cours);

		return redirect('/poles/cours');
	}

	/**
	 * Show the form for editing the specified lesson.
	 * Allow the creators to edit their lesson.
	 *
	 * @param cours: the lesson you want to edit.
	 * @return the view to edit the lesson.
	 */
	public function edit(Cours $cours)
	{
		$this->authorize('update', $cours);
		$users = User::all();
		return view('poles.cours.edit', compact('cours', 'users'));
	}

	/**
	 * Update the specified lesson.
	 *
	 * @param cours: the lesson you want to update.
	 * @return redirect to the lesson's specific page.
	 */
	public function update(Cours $cours)
	{
		$this->authorize('update', $cours);

		if (request()->has('link_support'))
		{
			foreach(request()->link_support as $key => $file)
			{
				$this->saveFile($file, $file->getClientOriginalName(), $cours, request()->visibility_new[$key]);
			}
		}

		if (request()->has('visibility_change'))
		{
			foreach (request()->visibility_change as $key => $value)
			{
				$this->changeVisibility($key, $value);
			}
		}

		$cours->update($this->validateCours());

		if(request()->has('cover'))
			$this->changeImage($cours);

		if (request()->has('creators'))
			$this->addCreators($cours);

		$cours->dates()->delete();

		$this->saveDates(request(), $cours);

		return redirect('/poles/cours/'.$cours->id);
	}

	/**
	 * Delete a lesson and everything attached to it.
	 *
	 * @param cours: the lesson you want to delete.
	 * @return redirect to the lesson's index.
	 */
	public function destroy(Cours $cours)
	{
		$this->authorize('update', $cours);

		$cours->dates()->delete();
		if (file_exists(storage_path('app/public/' . $cours->cover)) && substr($cours->icover, 0, 15) != "images/default/")
			unlink(storage_path('app/public/' . $cours->cover));

		foreach ($cours->supports as $file)
		{
			unlink(storage_path('app/' . $file->ref));
			$file->delete();
		}

		$cours->delete();

		return redirect('/poles/cours');
	}

	/**
	 * Validate the user's request to create a lesson.
	 *
	 * @return the validated request.
	 */
	public function validateCours ()
	{
		if (request()->has('cover'))
			return request()->validate([
				'title' => 'required',
				'desc' => 'required',
			]);
		else
			return request()->validate([
				'title' => 'required',
				'desc' => 'required'
			]);
	}

	/**
	 * Download a file.
	 *
	 * @param id: the id of the file the user wants to download.
	 * @return the link to download file with readable name.
	 */
	public function downloadFile ($id)
	{
		$supp = Support::where('id', $id)->first();
		return Storage::download($supp->ref, $supp->name);
	}

	/**
	 * Save a file in the database and in the support directory.
	 *
	 * @param file: the file you want to save.
	 * @param name: the name given before hatching.
	 * @param cours: the id of the lesson the file is attached to.
	 * @param visibility: the visibility of the lesson
	 *                    (1 = private/ 0 = public).
	 */
	public function saveFile ($file, $name, $cours, bool $visibility)
	{
		// save the file in the storage folder
		$path = Storage::putFile('supports', $file, 'private');

		// save the file in the database
		Support::create([ 'ref' => $path,
			'visibility' => $visibility,
			'name' => $name,
			'cours_id' => $cours->id
		]);
	}

	/**
	 * Save an image given by the user in the public storage folder.
	 *
     * @param image: the image to store.
	 * @return the path to find the image.
	 */
	public function saveImage ($image)
	{
		$path = Storage::putFile('public/images', $image, 'private');
        return substr($path, 7);
	}

	/**
	 * Save the dates that the user selected.
	 *
	 * @param request: the user's request.
	 * @param cours: the lesson to which the dates are linked to.
	 */
	public function saveDates (Request $request, Cours $cours)
	{
		if (request()->has('dates_pres'))
		{
			foreach ($request->dates_pres as $date)
			{
				$newDate = Date::create([
					'presentiel' => 1,
					'date' => $date
				]);
				$cours->dates()->attach($newDate->id);
			}
		}

		if (request()->has('dates_dist'))
		{
			foreach ($request->dates_dist as $date)
			{
				$newDate = Date::create([
					'presentiel' => 0,
					'date' => $date
				]);
				$cours->dates()->attach($newDate->id);
			}
		}
	}

	/**
	 * Add new creators (if they are not already in the list).
	 *
	 * @param cours: the lesson you want to add creators to.
	 */
	public function addCreators(Cours $cours)
	{
		foreach (request()->creators as $creator)
		{
			if ($cours->creators()->where('user_id', $creator)->count() == 0)
				$cours->creators()->attach($creator);
		}
	}

	/**
	 * Delete the first image if it's not a default image and set the new image.
	 *
	 * @param cours: the lesson we want to edit.
	 */
	public function changeImage(Cours $cours)
	{
		if (file_exists(storage_path('app/public/' . $cours->cover)) && substr($cours->cover, 0, 15) != "images/default/")
		{
			unlink(storage_path('app/public/' . $cours->cover));
		}

		$cours->cover = $this->saveImage(request()->cover);
		$cours->save();
	}

	/**
	 * Select a random default image.
	 *
	 * @return the path to the image.
	 */
	public function selectDefaultImage()
	{
		return 'images/default/cours/' . strval(random_int (1, 5) . '.jpg');
	}

	/**
	 * Change the visibility of existing files.
	 * 0: public
	 * 1: private
	 * 2: delete
	 *
	 * @param key: the id of the support we want to edit.
	 * @param value: the new visibility for the support.
	 */
	public function changeVisibility($key, $value)
	{
		$file = Support::find($key);

		if ($value == 2)
		{
			unlink(storage_path('app/' . $file->ref));
			$file->delete();
		}
		else
		{
			$file->visibility = $value;
			$file->save();
		}
	}
}
