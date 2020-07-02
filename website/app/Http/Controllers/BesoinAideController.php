<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Mail\BesoinAide;


class BesoinAideController extends Controller
{
    /**
     * Send contact email.
     */
    public function store(Request $request) 
    {
        // send the email
        Mail::to("info.telecom.strasbourg@gmail.com")
            ->send(new BesoinAide($request->type, $request->appareil, $request->os, $request->files, $request->desc));

        return redirect('/besoin-aide')
            ->with('message', 'Votre demande d\'aide a été envoyé.');
    }
}
