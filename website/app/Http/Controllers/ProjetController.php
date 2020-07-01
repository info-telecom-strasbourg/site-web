<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProjetRequest;
use App\Projet;
use App\User;
use App\Pole;
use App\Collaborateur;
use Illuminate\Http\Response;

use Illuminate\Http\UploadedFile;

use Illuminate\Support\Facades\Storage;

class ProjetController extends Controller
{
        /**
     * Display the list of projects.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projets = Projet::search()->filter()->paginate(24);

        $participants = User::all();

        $poles = Pole::all();
        
        $partners = Collaborateur::all();

        $search = request()->search;

        // filters options that has been selected
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
     * @param App|Projet $projet
     * @return \Illuminate\Http\Response
     */
    public function show(Projet $projet)
    {
        $projet->load('chef');
        $projet->load('participants');
        return view('projets.show', ['projet' => $projet]);
    }

    /**
     * Show the form to create a project.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Projet::class);
        $users = User::all();
        $poles = Pole::whereNotIn('slug', ['cours', 'competitions'])->get();
        return view('projets.create', compact('users', 'poles'));
    }

    /**
     * Store a new project.
     * 
     * @param  ProjetRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjetRequest $request)
    {
        $validatedData = $request->validated();
        $projet = Projet::create($validatedData);

        // if there are images, save the images, otherwise take a random one
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

        // the team leader is not present in the contributor list
        $teamLeaderPresent = false;

        // add the contributors to the database
        if ($request->has('participants')) 
        {
            foreach ($request->participants as $participant) 
            {
                $projet->participants()->attach($participant);

                // look if the team leader has been added to the contributors
                if ($participant == $request->chef_projet_id)
                    $teamLeaderPresent = true;
            }
        }

        // add the team leader to the contributors if he wasn't added
        if (!$teamLeaderPresent)
            $projet->participants()->attach($request->chef_projet_id);

        $projet->save();

        return redirect('/projets/'.$projet->id);
    }

    /**
     * Show the form for editing the specified project.
s     * 
     * @param App\projet $projet
     * @return \Illuminate\Http\Response
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
     * @param ProjetRequest $request
     * @param App\Projet $projet
     * @return \Illuminate\Http\Response
     */
    public function update(ProjetRequest $request, Projet $projet)
    {
        $this->authorize('update', $projet);

        // convert the json encoded string of the images paths
        // into an array
        $projetImages = json_decode($projet->images);

        // if some images needs to be removed
        if ($request->has('removeImages'))
        {
            foreach ($request->removeImages as $index => $value) 
            {
                // delete the image
                $this->deleteImage($projetImages[$index]);        

                // remove the images at given index
                unset($projetImages[$index]);
            }
        }

        // if there are images, save the images
        if ($request->has('images')) 
        {
            foreach ($request->images as $image) 
            {
                $projetImages[] = $this->saveImage($image, $projet);
            }
        }

        // if there are no images, take a default one
        if (empty($projetImages))
        {
            $projet->images = [$this->selectDefaultImage($projet->pole_id)];
        }
        else 
        {
            // store the images in a new array
            $idx = 0;
            $images = [];
            foreach ($projetImages as $image) 
            {
                $images[] = $image;
            }

            // convert the image array into 
            // a string containing the json representation
            $projet->images = json_encode($images);
        }

        // add the contributors to the database
        if ($request->has('participants')) 
        {
            foreach ($request->participants as $participant) 
            {
                $projet->participants()->attach($participant);
            }
        }

        // get edited data
        $validatedData = $request->validated();

        // updata project
        $projet->update($validatedData);

        return redirect('/projets/'.$projet->id);
    }

    /**
     * Remove the specified project.
     * 
     * @param App\Projet $projet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Projet $projet)
    {
        $this->authorize('update', $projet);

        // delete all images in storage
        foreach (json_decode($projet->images) as $image) 
            $this->deleteImage($image);        

        // delete the project
        $projet->delete();

        return redirect("/projets");
    }

    /**
     * Select a random default image.
     *
     * @return path to the image
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
     * @param $image: the image to be stored
     * @return path to find the image
     */
    public function saveImage($image)
    {
        $path = Storage::putFile('public/images', $image, 'private');
        return substr($path, 7);
    }

    /**
     * Delete an image in public storage folder.
     *
     * @param $imagePath: the image to be deleted
     */
    public function deleteImage($imagePath)
    {
        if (file_exists(storage_path('app/public/' . $imagePath)) && substr($imagePath, 0, 15) != "images/default/")
        {
                unlink(storage_path('app/public/' . $imagePath));
        }
    }
}
