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
     * @param int $id
     */
    public function show($id)
    {
        $projet = Projet::findOrFail($id);
        $projet->load('chef');
        $projet->load('participants');
        return view('projet.show', ['projet' => $projet]);
    }

    /**
     * Affiche la liste des projets
     * TODO : faire la vue associée
     */
    public function index($id)
    {
        $projets = Projet::all();
        return view('projet.index', ['projet' => $projets]);
    }

    /**
     * Renvoie le formulaire de création de projet
     * TODO : faire la vue associée
     */
    public function create()
    {
        return view('projet.create');
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
        $projet = Projet::create([
            'title' => $request->name,
            'images' => $request->images,
            'chef_projet_id' => $request->chef_projet_id,
            'link_github' => $request->link_github,
            'link_download' => $request->link_download,
            'link_doc' => $request->link_doc
        ]);

        $projet->save();

        return redirect('/projets');
    }

    /**
     * Affiche le formulaire d'édition de projet
     * TODO : la vue associée
     * 
     * @param int $id
     */
    public function edit($id)
    {
        $projet = Projet::find($id);

        return view('projet.edit', ['projet' => $projet]);
    }

    /**
     * Met à jour un projet
     * 
     * @param ProjetRequest $request
     * @param int $id
     * @return Response 
     */
    public function update(ProjetRequest $request, $id)
    {
        $validated = $request->validated();

        $projet = Projet::find($id);
        $projet->update([
            'title' => $request->name,
            'images' => $request->images,
            'chef_projet_id' => $request->chef_projet_id,
            'link_github' => $request->link_github,
            'link_download' => $request->link_download,
            'link_doc' => $request->link_doc
        ]);

        $projet->save();

        return redirect('/projets');
    }

    /**
     * Supprime un projet
     * 
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $projet = Projet::find($id);

        $projet->delete();

        return redirect("/projets");
    }
}
