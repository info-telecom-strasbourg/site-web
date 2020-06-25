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
	 * Get all the lessons
	 */
	public function index()
	{
		$pole = Pole::where('title', 'Cours')->first();
		$cours = Cours::orderBy('id', 'DESC')->get();
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
		$users = User::all();
		return view('poles.cours.create', compact('users'));
	}

	/**
	 * Store a new lesson
	 */
	public function store(Request $request)
	{
		$cours = Cours::create($this->validateCours());

		// Create the supports if they exists
		if ($request->has('link_support'))
			$this->saveFiles($request, $cours);


		//Create the image if it exists
		if($request->has('image_crs'))
			$cours->image = [$this->saveImage($request,$cours)];
		else
			$cours->image = ['images/default/'.strval(random_int ( 1 , 5 ).'.jpg')];
		$cours->save();

		//create the creators
		foreach ($request->creators as $creator)
			$cours->creators()->attach($creator);

		// create the dates
		$this->saveDates($request, $cours);

		return redirect('/poles/cours');
	}

	public function edit(Cours $cours)
	{
		$users = User::all();
		return view('poles.cours.edit',compact('cours', 'users'));
	}

	/**
	 * Update a lesson
	 */
	public function update(Cours $cours)
	{
		$cours->update($this->validateCours());

		if (request()->has('link_support'))
			$this->saveFiles(request(), $cours);

		//Create the image if it exists
		if(request()->has('image_crs'))
			$this->changeImage($cours);

		//add and delete files
		if (request()->has('del_file'))
			$this->deleteFiles($cours);

		if (request()->has('creators'))
			$this->addCreators($cours);

		//delete all the dates
		$cours->dates()->delete();

		// change the dates
		$this->saveDates(request(), $cours);

		return redirect('/poles/cours/'.$cours->id);
	}

	public function destroy(Cours $cours)
	{
		$cours->dates()->delete();
		if (file_exists(storage_path('app/public/'.json_decode($cours->image)[0])) && substr(json_decode($cours->image)[0],0,15) != "images/default/")
			unlink(storage_path('app/public/'.json_decode($cours->image)[0]));

		foreach ($cours->supports as $file)
		{
			unlink(storage_path('app/'.$file->ref));
			$file->delete();
		}
		$cours->delete();
		return redirect('/poles/cours');
	}

	public function validateCours ()
	{
		return request()->validate([
			'title' => 'required',
			'desc' => 'required'
		]);
	}

	public function downloadFile ($id)
	{
		$supp = Support::where('id', $id)->first();
		return Storage::download($supp->ref, $supp->name);
	}

	public function saveFiles (Request $request, Cours $cours)
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

	public function saveImage (Request $request, Cours $cours)
	{
		$path = Storage::putFile('public/images', $request->image_crs, 'private');
		return substr($path, 7);
	}

	public function saveDates (Request $request, Cours $cours)
	{
		if (request()->has('dates_pres'))
			foreach ($request->dates_pres as $date)
			{
				$newDate = Date::create(['presentiel' => 1,
					'date' => $date
				]);
				$cours->dates()->attach($newDate->id);
			}

		if (request()->has('dates_dist'))
			foreach ($request->dates_dist as $date)
			{
				$newDate = Date::create(['presentiel' => 0,
					'date' => $date
				]);
				$cours->dates()->attach($newDate->id);
			}
	}

	public function addCreators(Cours $cours)
	{
		foreach (request()->creators as $creator)
			if ($cours->creators()->where('user_id',$creator)->count() == 0)
				$cours->creators()->attach($creator);
	}

	public function deleteFiles(Cours $cours)
	{
		foreach (request()->del_file as $file)
		{
			$fileToDel = $cours->supports->where('ref', $file)->first();
			unlink(storage_path('app/'.$fileToDel->ref));
			$fileToDel->delete();
		}
	}

	public function changeImage(Cours $cours)
	{
		if (file_exists(storage_path('app/public/'.json_decode($cours->image)[0])) && substr(json_decode($cours->image)[0],0,15) != "images/default/")
			unlink(storage_path('app/public/'.json_decode($cours->image)[0]));

		$cours->image = [$this->saveImage(request(),$cours)];
		$cours->save();
	}
}
