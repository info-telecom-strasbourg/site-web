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
        else
            $compet->images = [$this->selectDefaultImage()];

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
	 * Select a random default image.
	 *
	 * @return path to the image
	 */
	public function selectDefaultImage()
	{
		return 'images/default/prog/' . strval(random_int (1, 5) . '.jpg');
	}
}
