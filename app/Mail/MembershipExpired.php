<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MembershipExpired extends Mailable
{
    use Queueable, SerializesModels;

    public $username;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($username)
    {
        $this->username = $username;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
          ->from('app.mailer01@gmail.com')
          ->view('emails.membership_expired');
    }
}
