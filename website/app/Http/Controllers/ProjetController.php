<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Projet;
use Illuminate\Http\Request;
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
        return view('projet.show', ['projet' => $projet]);
    }

    /**
     * Affiche la liste des projets
     * TODO : faire la vue associée
     */
    public function index($id)
    {
        abort(400, "Not implemented");
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
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'link_github' => 'url',
            'link_download' => 'url',
            'link_doc' => 'url',
            'chef_projet_id' => '',
            'pole_id' => ''

        ]);

        $projet = Projet::create([
            'title' => $request->name,
            'link_github' => $request->link_github,
            'link_download' => $request->link_download,
            'link_doc' => $request->link_doc
        ]);

        return redirect('/projets');
    }
}
