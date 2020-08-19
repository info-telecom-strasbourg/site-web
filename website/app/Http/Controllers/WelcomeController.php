<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMe;
use App\Pole;
use App\News;
use App\User;
use App\Projet;
use App\Role;
use App\Collaborateur;
use App\RandomProjet;

/**
 * Controller linked to the welcome page.
 */
class WelcomeController extends Controller
{
	/**
	 * Get data for welcome page.
	 */
    public function welcome()
    {
    	$poles = Pole::all();

        $rolesIds = Role::whereIn('poste', array('Bureau', 'Respo'))->get(['id']);

        $team = User::whereIn('role_id', $rolesIds)->get();

        $partners = Collaborateur::all();

        $nbProjets = Projet::count();

        $nbUsers = User::count();

        $nbPoles = Pole::count();

		$allNews = News::where('position', '!=', '0')->orderBy('position')->get();
		$defaultNews = News::where('position', '==', '0')->first();

        $years = date("Y") - 2019;



        // get the date and time to know if the projects needs to be updated
        $day = date('z') % 14;
        $hour = date('H');
        $min = date('i');
        $seconds = date('s');

        // every 2 weeks get new random projects
        if ($day == 0 && $hour == 0 && $min == 0 && $seconds == 0)
        {
            RandomProjet::truncate();

            // get max random number
            if ($nbProjets == 1)
                $maxProjets = 1;
            else if ($nbProjets < 6)
                $maxProjets = $nbProjets;
            else
                $maxProjets = 6;

            if ($maxProjets == 1)
            {
                $projet = Projet::first();
                RandomProjet::create(['projet_id' => $projet->id]);
            }
            else
            {
                $projetArray = Projet::all()->toArray();

                // get 6 random project ids
                $randIds = array_rand($projetArray, $maxProjets);

                foreach ($randIds as $id)
                {
                    RandomProjet::create(['projet_id' => array_values($projetArray[$id])[0]]);
                }
            }
        }

        $projets = RandomProjet::all();

        return view('welcome', compact('poles', 'team', 'partners', 'projets',
		'nbProjets', 'nbUsers', 'nbPoles', 'years', 'allNews', 'defaultNews'));
    }

    /**
     * Send contact email.
	 *
	 * @param request: the user's request.
	 * @return redirect to the contact part of the home page.
     */
    public function store(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        Mail::to($request->email)
            ->send(new ContactMe($request->name, $request->subject, $request->email, $request->messages));

        return redirect('/#contact-anchor')
            ->with('message', 'Votre demande de contact a été envoyé.');
    }
}
