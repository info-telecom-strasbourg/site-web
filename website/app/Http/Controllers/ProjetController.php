<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjetRequest;
use App\Projet;
use App\User;
use App\Pole;
use App\Collaborateur;
use Illuminate\Http\Response;

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
     * TODO : faire la vue associée
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projets.create');
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
        $projet = Projet::create($request->validated());

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
        return view('projets.edit', ['projet' => $projet]);
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
        $validated = $request->validated();

        $projet->update($validated);

        return redirect('/projets');
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
}
