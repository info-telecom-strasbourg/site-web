<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class to send an email with the section "Besoin d'aide"
 */
class BesoinAide extends Mailable
{
    use Queueable, SerializesModels;

    public $type;
    public $appareil;
    public $os;
    public $files;
    public $desc;

    /**
     * Create a new message instance.
     */
    public function __construct($email, $type, $appareil, $os, $files, $desc)
    {
        $this->email = $email;
        $this->type = $type;
        $this->appareil = $appareil;
        $this->os = $os;
        $this->files = $files;
        $this->desc = $desc;
    }

    /**
     * Build the message.
     *
     * @return this
     */
    public function build()
    {
        $email =  $this->markdown('emails.besoin-aide')->replyTo($this->email)->subject('[Besoin d\'aide] ' . $this->type);


        // add attachments to the mail
        foreach ($this->files as $files) {
            foreach ($files as $file) {
                $email->attach($file, [
                    'as' => $file->getClientOriginalName(),
                ]);
            }
            break;
        }

        return $email;
    }
}
