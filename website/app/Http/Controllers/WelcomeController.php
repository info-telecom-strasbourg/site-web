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

        // get the date and time to know if the projects needs to be updated
        $day = date('z') % 14;
        $hour = date('H');
        $min = date('i');
        $seconds = date('s');

        if ($day == 0 && $hour == 0 && $min == 0 && $seconds == 0)
        {
            // random
        }

        /** Numbers **/
        // get number of projects
        $nbProjets = Projet::count();

        // get number of users
        $nbUsers = User::count();

        // get number of poles
        $nbPoles = Pole::count();

        // get number of years since the creation of ITS
        $years = date("Y") - 2019;


        return view('welcome', compact('poles', 'team', 'partners', 'nbProjets', 'nbUsers', 'nbPoles', 'years'));
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
