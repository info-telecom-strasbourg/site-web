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
        $users = User::all();
        $poles = Pole::all();
        return view('projets.create', compact('users', 'poles'));
    }

    /**
     * Store a new project.
     *
     * TODO : verfifier les droits de l'utilisateur
     * TODO : error handling
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

        return redirect('/projets');
    }

    /**
     * Show the form for editing the specified project.
     * TODO : la vue associée
     * 
     * @param App\projet $projet
     * @return \Illuminate\Http\Response
     */
    public function edit(Projet $projet)
    {
        $users = User::all();
        $poles = Pole::all();
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
        $validatedData = $request->validated();

        $projet->update($validatedData);

        return view('projets.show', compact('projet'));
    }

    /**
     * Remove the specified project.
     * 
     * @param App\Projet $projet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Projet $projet)
    {
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
                return 'storage/images/default/cours/'.strval(random_int (1, 5).'.jpg');
                break;
            case 2:
                return 'storage/images/default/web/'.strval(random_int (1, 5).'.jpg');
                break;
            case 3:
            case 4:
                return 'storage/images/default/prog/'.strval(random_int (1, 5).'.jpg');
                break;
            case 5:
                return 'storage/images/default/jeux/'.strval(random_int (1, 5).'.jpg');
                break;
            default:
                return 'storage/images/default/'.strval(random_int (1, 5).'.jpg');
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
        $path = Storage::putFile('public/images/', $image, 'private');
        return 'storage/'.substr($path, 7);
    }
}
