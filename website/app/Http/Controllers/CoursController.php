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

class CoursController extends Controller
{
	/**
	 * Display all lessons with associate pole and send them to the index view.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$pole = Pole::where('slug', 'cours')->first();
		$cours = Cours::orderBy('id', 'DESC')->get();
		return view('poles.cours.index', ['cours' => $cours, 'pole' => $pole]);
	}

	/**
	 * Show a specified lesson.
	 *
	 * @param App\Cours $cours: the lesson you want to display
	 * @return \Illuminate\Http\Response
	 */
	public function show(Cours $cours)
	{
		return view('poles.cours.show', compact('cours'));
	}

	/**
	 * Show the form to create a lesson.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$users = User::all();
		return view('poles.cours.create', compact('users'));
	}

	/**
	 * Store a new lesson.
	 *
	 * @param \Illuminate\Http\Request $request: the user request
	 * @return \Illuminate\Http\Response to the lesson's index page
	 */
	public function store(Request $request)
	{
		$cours = Cours::create($this->validateCours());

		// if there are supports, save them
		if ($request->has('link_support'))
		{
			foreach ($request->link_support as $file)
			{
				$name = $file->getClientOriginalName();
				$this->saveFile($file, $name, $cours, ($request->has('visibility')) ? array_key_exists($name, $request->visibility) : 0);
			}
		}

		// if there is an image, save the image, otherwise take a random one
		if($request->has('image_crs'))
			$cours->image = [$this->saveImage($request, $cours)];
		else
			$cours->image = [$this->selectDefaultImage()];

		// save the lesson
		$cours->save();

		// add the creators to the bdd
		foreach ($request->creators as $creator)
			$cours->creators()->attach($creator);

		// save lessons dates
		$this->saveDates($request, $cours);

		return redirect('/poles/cours');
	}

	/**
	 * Show the form for editing the specified lesson.
	 * Allow the creators to edit their lesson.
	 *
	 * @param App\Cours $cours: the lesson you want to edit
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Cours $cours)
	{
		$users = User::all();
		return view('poles.cours.edit',compact('cours', 'users'));
	}

	/**
	 * Update the specified lesson.
	 *
	 * @param App\Cours $cours: the lesson you want to update
	 * @return \Illuminate\Http\Response to the lesson's specific page
	 */
	public function update(Cours $cours)
	{
		// if there are supports, save them
		if (request()->has('link_support')) 
		{
			foreach(request()->link_support as $key => $file) 
			{
				$this->saveFile($file, $file->getClientOriginalName(), $cours, request()->visibility_new[$key]);
			}
		}

		// change the visibility of the supports if it has changed
		if (request()->has('visibility_change')) 
		{
			foreach (request()->visibility_change as $key => $value) 
			{
				$this->changeVisibility($key, $value);
			}
		}

		// update the lesson
		$cours->update($this->validateCours());

		// change lesson's image
		if(request()->has('image_crs'))
			$this->changeImage($cours);

		// add creators
		if (request()->has('creators'))
			$this->addCreators($cours);

		// delete old dates
		$cours->dates()->delete();

		// save new dates
		$this->saveDates(request(), $cours);

		return redirect('/poles/cours/'.$cours->id);
	}

	/**
	 * Delete a lesson and everything attached to it.
	 *
	 * @param App\Cours $cours: the lesson you want to delete
	 * @return \Illuminate\Http\Response to the lesson's index
	 */
	public function destroy(Cours $cours)
	{
		// delete all dates associate to the lesson in database and in storage
		$cours->dates()->delete();
		if (file_exists(storage_path('app/public/'.json_decode($cours->image)[0])) && substr(json_decode($cours->image)[0],0,15) != "images/default/") 
		{
			unlink(storage_path('app/public/'.json_decode($cours->image)[0]));
		}

		// delete all supports in database and in storage
		foreach ($cours->supports as $file)
		{
			unlink(storage_path('app/'.$file->ref));
			$file->delete();
		}

		// delete the lesson
		$cours->delete();

		return redirect('/poles/cours');
	}

	/**
	 * Validate the user's request to create a lesson
	 *
	 * @return validated request
	 */
	public function validateCours ()
	{
		return request()->validate([
			'title' => 'required',
			'desc' => 'required'
		]);
	}

	/**
	 * Download a file.
	 *
	 * @param id: the id of the file the user wants to download
	 * @return link to download file with readable name
	 */
	public function downloadFile ($id)
	{
		$supp = Support::where('id', $id)->first();
		return Storage::download($supp->ref, $supp->name);
	}

	/**
	 * Save a file in the database and in the support directory.
	 *
	 * @param file: the file you want to save
	 * @param name: the name given before hatching
	 * @param cours: the id of the lesson the file is attached to
	 * @param visibility: the visibility of the lesson (1 = private/ 0 = public)
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
	 * @param \Illuminate\Http\Request  $request: the request of the user
	 * @return path to find the image
	 */
	public function saveImage (Request $request)
	{
		$path = Storage::putFile('public/images', $request->image_crs, 'private');
		return substr($path, 7);
	}

	/**
	 * Save the dates that the user selected.
	 *
	 * @param \Illuminate\Http\Request  $request: the user's request
	 * @param cours: the lesson to which the dates are linked to
	 */
	public function saveDates (Request $request, Cours $cours)
	{
		// if there are face-to-face dates
		if (request()->has('dates_pres'))
		{
			foreach ($request->dates_pres as $date)
			{
				// create a new date in the database
				$newDate = Date::create(['presentiel' => 1,
					'date' => $date
				]);

				// add the date to the list of dates for this lesson
				$cours->dates()->attach($newDate->id);
			}
		}

		// if there are remote dates
		if (request()->has('dates_dist'))
		{
			foreach ($request->dates_dist as $date)
			{
				// create a new date in the database
				$newDate = Date::create(['presentiel' => 0,
					'date' => $date
				]);

				// add the date to the list of dates for this lesson
				$cours->dates()->attach($newDate->id);
			}
		}
	}

	/**
	 * Add new creators (if they are not already in the list).
	 *
	 * @param App\Cours $cours: the lesson you want to add creators to
	 */
	public function addCreators(Cours $cours)
	{
		foreach (request()->creators as $creator) 
		{
			if ($cours->creators()->where('user_id',$creator)->count() == 0)
				$cours->creators()->attach($creator);
		}
	}

	/**
	 * Delete the first image if it's not a default image and set the new image.
	 *
	 * @param App\Cours $cours: the lesson we want to edit
	 */
	public function changeImage(Cours $cours)
	{
		if (file_exists(storage_path('app/public/'.json_decode($cours->image)[0])) && substr(json_decode($cours->image)[0],0,15) != "images/default/") 
		{
			unlink(storage_path('app/public/'.json_decode($cours->image)[0]));
		}

		$cours->image = [$this->saveImage(request(), $cours)];
		$cours->save();
	}

	/**
	 * Select a random default image.
	 *
	 * @return path to the image
	 */
	public function selectDefaultImage()
	{
		return 'images/default/cours/'.strval(random_int ( 1 , 5 ).'.jpg');
	}

	/**
	 * Change the visibility of existing files.
	 * 0: public
	 * 1: private
	 * 2: delete
	 *
	 * @param key: the id of the support we want to edit
	 * @param value: the new visibility for the support
	 */
	public function changeVisibility($key, $value)
	{
		$file = Support::find($key);

		// if the value is 2 delete the file
		if ($value == 2)
		{
			unlink(storage_path('app/'.$file->ref));
			$file->delete();
		}
		else 	// change the visibiity of the file
		{
			$file->visibility = $value;
			$file->save();
		}
	}
}
