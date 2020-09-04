<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProjetRequest;
use App\Projet;
use App\User;
use App\Pole;
use Carbon\Carbon;
use App\Collaborateur;
use App\TimelineEvent;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

/**
 * Controller linked to projects.
 */
class ProjetController extends Controller
{
	/**
     * Display the list of projects.
     *
     * @return the view with all the projects.
     */
    public function index()
    {
        $projets = Projet::search()->filter()->paginate(24);

        $participants = User::all();

        $poles = Pole::all();
        $partners = Collaborateur::all();

        $search = request()->search;

        $filters = [];
        $filters[0] = request()->pole;
        $filters[1] = request()->membre;
        $filters[2] = request()->partner;
        $filters[3] = request()->trie;

        return view('projets.index', compact('projets', 'poles', 'participants', 'partners', 'search', 'filters'));
    }

    /**
     * Display a specific project.
     *
     * @param projet: the page of this project will be displayed.
     * @return the project's view.
     */
    public function show(Projet $projet)
    {
        $projet->load('chef');
        $projet->load('participants');
        return view('projets.show', compact('projet'));
    }

    /**
     * Show the form to create a project.
     *
     * @return the view to create a project.
     */
    public function create()
    {
        $this->authorize('create', Projet::class);
        $users = User::all();
        $pole = Pole::where('respo_id', '=', Auth::user()->id)->first();
        $partners = Collaborateur::all();

        return view('projets.create', compact('users', 'pole', 'partners'));
    }

    /**
     * Store a new project. It also create a defaultevent in the timeline of the
	 * project.
     *
     * @param  request: the user's request.
     * @return redirect to the page of the stored project.
     */
    public function store(ProjetRequest $request)
    {
        $validatedData = $request->validated();
        $request->validate([
            'images' => 'array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $projet = Projet::create($validatedData);

        if ($request->has('images'))
        {
            $projetImages = [];
            foreach ($request->images as $image)
            {
                $projetImages[] = $this->saveImage($image, $projet);
            }
            $projet->images = json_encode($projetImages);
        }
        else
            $projet->images = [$this->selectDefaultImage($projet->pole_id)];

        $teamLeaderPresent = false;

        if ($request->has('participants'))
        {
            foreach ($request->participants as $participant)
            {
                if ($participant == $request->chef_projet_id)
                    $teamLeaderPresent = true;

                $projet->participants()->attach($participant);
            }
        }

        if (!$teamLeaderPresent)
            $projet->participants()->attach($request->chef_projet_id);

        $projet->save();

		$today = Carbon::now('Europe/Paris')->format('Y-m-d');

		TimelineEvent::create([
			'desc' => 'Début du projet',
			'date' => $today,
			'reference_id' => $projet->id,
			'timeline_type' => 'App\Projet',
		]);


        return redirect('/projets/' . $projet->id);
    }

    /**
     * Show the form for editing the specified project.
     *
     * @param projet: the project to edit.
     * @return the view to edit the project.
     */
    public function edit(Projet $projet)
    {
        $this->authorize('update', $projet);
        $users = User::all();
        $poles = Pole::whereNotIn('slug', ['cours', 'competitions'])->get();
        return view('projets.edit', compact('projet', 'users', 'poles'));
    }

    /**
     * Update the specified project.
     *
     * @param request: user's request.
     * @param projet: the project to update.
     * @return redirect to the updated project's page.
     */
    public function update(ProjetRequest $request, Projet $projet)
    {
        $this->authorize('update', $projet);

        $request->validate([
            'images' => 'array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $projetImages = json_decode($projet->images);


        if ($request->has('removeImages'))
        {
            foreach ($request->removeImages as $index => $value)
            {
                $this->deleteImage($projetImages[$index]);
                unset($projetImages[$index]);
            }
        }

        if ($request->has('images'))
        {
            foreach ($request->images as $image)
            {
                if(substr($projetImages[0], 0, 15) == "images/default/")
                    $projetImages[0] = $this->saveImage($image, $projet);
                else
                    $projetImages[] = $this->saveImage($image, $projet);
            }
        }

        if (empty($projetImages))
        {
            $projet->images = [$this->selectDefaultImage($projet->pole_id)];
        }
        else
        {
            $images = [];
            foreach ($projetImages as $image)
            {
                $images[] = $image;
            }
            $projet->images = json_encode($images);
        }

        if ($request->has('participants'))
        {
            foreach ($request->participants as $participant)
            {
                $projet->participants()->attach($participant);
            }
        }

        if ($request->has('del_participants'))
        {
            foreach ($request->del_participants as $participant)
            {
                $projet->participants()->detach($participant);
            }
        }

        if (!$request->has('complete'))
            $projet->complete = 0;
        
        $projet->save();

        $validatedData = $request->validated();

        $projet->update($validatedData);

        return redirect('/projets/'.$projet->id);
    }

    /**
     * Remove the specified project. It also delete all the events atached to
	 * it.
     *
     * @param projet: the project to delete.
     * @return redirect to projects' index view.
     */
    public function destroy(Projet $projet)
    {
        $this->authorize('delete', $projet);

        foreach (json_decode($projet->images) as $image)
            $this->deleteImage($image);

        // delete the associate comments
        foreach ($projet->comments as $comment) {
            foreach ($comment->comments as $replyComment)
                $replyComment->delete();
            $comment->delete();
        }

        // delete the events of the timeline
        foreach ($projet->timeline as $key => $event)
			     $event->delete();

        $projet->delete();

        return redirect("/projets");
    }

    /**
     * Select a random default image.
     *
     * @return the path to the image.
     */
    public function selectDefaultImage($poleId)
    {
        switch ($poleId) {
            case 1:
                return 'images/default/cours/' . strval(random_int (1, 5).'.jpg');
                break;
            case 2:
                return 'images/default/web/' . strval(random_int (1, 5).'.jpg');
                break;
            case 3:
            case 4:
                return 'images/default/prog/' . strval(random_int (1, 5).'.jpg');
                break;
            case 5:
                return 'images/default/jeux/' . strval(random_int (1, 5).'.jpg');
                break;
            default:
                return 'images/default/' . strval(random_int (1, 5).'.jpg');
                break;
        }
    }

    /**
     * Save an image given by the user in the public storage folder.
     *
     * @param image: the image to be stored
     * @return the path to find the image
     */
    public function saveImage($image)
    {
        $path = Storage::putFile('public/images/projets/', $image, 'public');
        return substr($path, 7);
    }

    /**
     * Delete an image in public storage folder.
     *
     * @param imagePath: the image to be deleted
     */
    public function deleteImage($imagePath)
    {
        if (file_exists(storage_path('app/public/' . $imagePath)) && substr($imagePath, 0, 15) != "images/default/")
        {
                unlink(storage_path('app/public/' . $imagePath));
        }
    }
}
