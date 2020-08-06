<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Competition;
use App\Pole;
use App\Date;
use Illuminate\Support\Facades\Storage;

/**
 * Controller linked to the competitions.
 */
class CompetitionController extends Controller
{
	/**
	 * List all the competitions.
	 *
	 * @return a view with the list of all competitions.
	 */
    public function index()
	{
		return view('poles.competitions.index', [ 'compets' => Competition::all(), 'pole' => Pole::where('slug', 'competitions')->first() ]);
	}

	/**
	 * Show a specified competition.
	 *
	 * @param compet: the competition that will be shown.
	 * @return the view of the competition.
	 */
	public function show(Competition $compet)
	{
		return view('poles.competitions.show', [ 'compet' => $compet ]);
	}

	/**
	 * Show the form to create a competition if the user is authorised to do so.
	 *
	 * @return the view to create a competition.
	 */
	public function create()
	{
		$this->authorize('create', Competition::class);
		return view('poles.competitions.create');
	}

	/**
	 * Store a new competition.
	 *
	 * @return redirect to the stored competition's page.
	 */
	public function store(Request $request)
	{
		$compet = Competition::create($this->validateCompetiton());

		/* add dates */
		foreach ($request->dates_comp as $date)
		{
			$newDate = Date::create([
				'presentiel' => 1,
				'date' => $date
			]);
			$compet->dates()->attach($newDate->id);
		}

		/* add images */
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

        $compet->save();

		return redirect('/poles/competitions/' . $compet->id);
	}

	/**
	 * Show the form for editing the specified competition.
	 *
	 * @param compet: the competition to edit.
	 * @return the view to edit the competition
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
		//TODO update for competitions
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
     * @param image: the image to store.
     * @return the path to find the image.
     */
    public function saveImage($image)
    {
        $path = Storage::putFile('public/images', $image, 'private');
        return substr($path, 7);
    }

   	/**
	 * Select a random default image.
	 *
	 * @return the path to the image
	 */
	public function selectDefaultImage()
	{
		return 'images/default/prog/' . strval(random_int (1, 5) . '.jpg');
	}
}
