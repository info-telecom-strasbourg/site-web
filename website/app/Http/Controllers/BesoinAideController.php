<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\BesoinAide;
use App\User;

/**
 * Controller linked to the section "Besion d'aide".
 */
class BesoinAideController extends Controller
{
    /**
     * Send an email to "info.telecom.strasbourg@gmail.com".
	 *
	 * @param request: the user's request
	 * @return redirect to "/besoin-aide" and display a message
     */
    public function store(Request $request)
    {
        Mail::to("info.telecom.strasbourg@gmail.com")
            ->send(new BesoinAide(Auth::user()->email, $request->type, $request->appareil, $request->os, $request->files, $request->desc));

        return redirect('/besoin-aide')
            ->with('message', 'Votre demande d\'aide a été envoyé.');
    }
}
