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

    public $password;
    public $id;

    /**
     * Create a new message instance.
     */
    public function __construct($password, $id)
    {
        $this->password = $password;
        $this->id = $id;
    }

    /**
     * Build the message.
     *
     * @return this
     */
    public function build()
    {
        return $this->markdown('emails.change-password')->subject('Bienvenue à ITS !');
    }
}
