<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMe extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $subject;
    public $email;
    public $messages;

    
    /**
     * Create a new message instance.
     *
     * @param $name: the name of the person that contacts us
     * @param $subject: subject of the contact request
     * @param $email: email of the person
     * @param $message: contact message
     * @return void
     */
    public function __construct($name, $subject, $email, $messages)
    {
        $this->name = $name;
        $this->subject = $subject;
        $this->email = $email;
        $this->messages = $messages;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.contact-me')
            ->replyTo($this->email)
            ->subject('[Contact] ' . $this->subject);
    }
}
