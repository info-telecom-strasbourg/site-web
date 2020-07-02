<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Mail\ContactMe;

use App\Pole;
use App\User;
use App\Projet;
use App\Role;
use App\Collaborateur;
use App\RandomProjet;

class WelcomeController extends Controller
{
	/**
	 * Get data for welcome page.
	 */
    public function welcome()
    {
    	/** Data **/
    	// get all poles
    	$poles = Pole::all();

    	// get roles ids for the team
    	$rolesIds = Role::whereIn('poste', array('Bureau', 'Respo'))->get(['id']);
    	// get the team
        $team = User::whereIn('role_id', $rolesIds)->get();

        // get all partners
        $partners = Collaborateur::all();

        /** Numbers **/
        // get number of projects
        $nbProjets = Projet::count();

        // get number of users
        $nbUsers = User::count();

        // get number of poles
        $nbPoles = Pole::count();

        // get number of years since the creation of ITS
        $years = date("Y") - 2019;


        // get the date and time to know if the projects needs to be updated
        $day = date('z') % 14;
        $hour = date('H');
        $min = date('i');
        $seconds = date('s');

        // every 2 weeks get new random projects
        if ($day == 0 && $hour == 0 && $min == 0 && $seconds == 0)
        {
            // delete all projects in database
            RandomProjet::truncate();

            // get max random number
            if ($nbProjets < 6)
                $maxProjets = $nbProjets;
            else
                $maxProjets = 6;

            // get all projects in an array
            $projetArray = Projet::all()->toArray();

            // get 6 random project ids
            $randIds = array_rand($projetArray, $maxProjets);

            // create random projects
            foreach ($randIds as $id) 
            {
                RandomProjet::create(['projet_id' => array_values($projetArray[$id])[0]]);
            }
        }


        $projets = RandomProjet::all();

        return view('welcome', compact('poles', 'team', 'partners', 'projets', 'nbProjets', 'nbUsers', 'nbPoles', 'years'));
    }

    /**
     * Send contact email.
     */
    public function store(Request $request) 
    {
        $request->validate(['email' => 'required|email']);

        // send the email
        Mail::to($request->email)
            ->send(new ContactMe($request->name, $request->subject, $request->email, $request->messages));

        return redirect('/#contact-anchor')
            ->with('message', 'Votre demande de contact a été envyoyé.');
    }
}
