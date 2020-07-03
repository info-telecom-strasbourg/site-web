<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Competition;

use App\Pole;

use App\Date;

use App\User;

use Illuminate\Support\Facades\Storage;

class CompetitionController extends Controller
{
	/**
	 * List all the competitions.
	 *
	 * @return \Illuminate\Http\Response
	 */
    public function index()
	{
		return view('poles.competitions.index', [ 'compets' => Competition::all(), 'pole' => Pole::where('slug', 'competitions')->first() ]);
	}

	/**
	 * Show a specified competition.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show(Competition $compet)
	{
		$pole = Pole::where('slug', 'competitions')->first();
		return view('poles/competitions/show', [ 'compet' => $compet, 'pole' => $pole ]);
	}

	/**
	 * Show the form to create a competition.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$this->authorize('create', Competition::class);
		$users = User::all();
		return view('poles.competitions.create', compact('users'));
	}

	/**
	 * Store a new competition.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$compet = Competition::create($this->validateCompetiton());

		// add dates
		foreach ($request->dates_comp as $date)
		{
			// create a new date in the database
			$newDate = Date::create([
				'presentiel' => 1,
				'date' => $date
			]);

			// add the date to the list of dates for this lesson
			$compet->dates()->attach($newDate->id);
		}

		//add the cover image
		$compet->cover = $this->saveImage($request->cover);

		// add images
		if ($request->has('images'))
        {
            $competImages = [];
            foreach ($request->images as $image)
            {
                $competImages[] = $this->saveImage($image);
            }
            $compet->images = json_encode($competImages);
        }

		// add creators
		if ($request->has('competitors'))
			$this->addCompetitors($compet);

		if($request->has('place'))
			$compet->place = $request->place;

        // save competition
        $compet->save();

		return redirect('/poles/competitions/' . $compet->id);
	}

	/**
	 * Show the form for editing the specified competition.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Competition $compet)
	{
		$this->authorize('update', 'App\Competition');
		$users = User::all();
		return view('poles.competitions.edit', compact('compet', 'users'));
	}

	/**
	 * Update the specified competition.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update(Competition $compet)
	{
		$this->authorize('update', 'App\Competition');

		$compet->update($this->validateCompetiton());

		//change the cover
		if(request()->has('cover'))
		{
			unlink(storage_path('app/public/' . $compet->cover));
			$compet->cover = $this->saveImage(request()->cover);
		}

		//add images
		if (request()->has('link_im_comp'))
		{
			if(isset($compet->images))
				$images = json_decode($compet->images);
			else
				$images = [];


			foreach(request()->link_im_comp as $image)
				$images[] = $this->saveImage($image);

			$compet->images = json_encode($images);
		}

		//del images
		if (request()->has('remove_images'))
		{
			$images = [];
			foreach (json_decode($compet->images) as $key => $value)
			{
				if(!in_array($value, request()->remove_images, true))
					$images[] = $value;
				else
					unlink(storage_path('app/public/' . $value));
			}
			$compet->images = json_encode($images);
		}

		//add competitors
		if (request()->has('competitors'))
			$this->addCompetitors($compet);

		if (request()->has('del_competitors'))
			$this->delCompetitors($compet);

		// delete old dates
		$compet->dates()->delete();

		$this->saveDates($compet);

		if (request()->has('place'))
			$compet->place = request()->place;

		$compet->save();

		return redirect('/poles/competitions/' . $compet->id);
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
			'website' => 'required'
		]);
	}

	/**
     * Save an image given by the user in the public storage folder.
     *
     * @param $image: the image to be stored
     * @return path to find the image
     */
    public function saveImage($image)
    {
        $path = Storage::putFile('public/images', $image, 'private');
        return substr($path, 7);
    }

	/**
	 * Add new competitors (if they are not already in the list).
	 *
	 * @param App\Competition $compet: the competition you want to add competitors to
	 */
	public function addCompetitors(Competition $compet)
	{
		foreach (request()->competitors as $competitor)
		{
			if ($compet->competitors()->where('user_id', $competitor)->count() == 0)
				$compet->competitors()->attach($competitor);
		}
	}

	/**
	 * Delete competitors (if they are not already in the list).
	 *
	 * @param App\Competition $compet: the competition you want to delete competitors to
	 */
	public function delCompetitors(Competition $compet)
	{
		foreach (request()->del_competitors as $competitor)
		{
			if ($compet->competitors()->where('user_id', $competitor)->count() == 1)
				$compet->competitors()->detach($competitor);
		}
	}

	public function saveDates(Competition $compet)
	{
		foreach (request()->dates_comp as $date)
		{
			// create a new date in the database
			$newDate = Date::create([
				'presentiel' => 1,
				'date' => $date
			]);

			// add the date to the list of dates for this lesson
			$compet->dates()->attach($newDate->id);
		}
	}
}
