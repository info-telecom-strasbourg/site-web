<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class to send an email with the section "Besoin d'aide"
 */
class ChangePassword extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $password;

    /**
     * Create a new message instance.
     */
    public function __construct($name, $password)
    {
        $this->name = $name;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return this
     */
    public function build()
    {
        $email =  $this->markdown('emails.change-password')->subject('Bienvenue à ITS !');
		
        return $email;
    }
}
