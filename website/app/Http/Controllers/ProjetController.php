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
     * Affiche un projet sur une page seule
     * @param Projet $projet
     */
    public function show(Projet $projet)
    {
        $projet->load('chef');
        $projet->load('participants');
        return view('projets.show', ['projet' => $projet]);
    }

    /**
     * Affiche la liste des projets
     * @return \Illuminate\Http\Response
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
     * Renvoie le formulaire de création de projet
     * TODO : faire la vue associée
     */
    public function create()
    {
        return view('projets.create');
    }

    /**
     * Enregistre un nouveau projet
     *
     * TODO : verfifier les droits de l'utilisateur
     * TODO : error handling
     * 
     * @param  ProjetRequest $request
     * @return Response
     */
    public function store(ProjetRequest $request)
    {
        $validated = $request->validated();

        $projet = Projet::create($validated);

        return redirect('/projets');
    }

    /**
     * Affiche le formulaire d'édition de projet
     * TODO : la vue associée
     * 
     * @param Projet $projet
     */
    public function edit(Projet $projet)
    {
        return view('projets.edit', ['projet' => $projet]);
    }

    /**
     * Met à jour un projet
     * 
     * @param ProjetRequest $request
     * @param Projet $projet
     * @return Response 
     */
    public function update(ProjetRequest $request, Projet $projet)
    {
        $validated = $request->validated();

        $projet->update($validated);

        return redirect('/projets');
    }

    /**
     * Supprime un projet
     * 
     * @param Projet $projet
     * @return Response
     */
    public function destroy(Projet $projet)
    {
        $projet->delete();

        return redirect("/projets");
    }
}
