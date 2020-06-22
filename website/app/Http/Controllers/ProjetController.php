<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjetRequest;
use App\Projet;
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
     * TODO : faire la vue associée
     */
    public function index()
    {
        $projets = Projet::all();
        return view('projets.index', ['projet' => $projets]);
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
