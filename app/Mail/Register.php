<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Register extends Mailable
{
    use Queueable, SerializesModels;

    public $confirmation_code;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($confirmation_code)
    {
      $this->confirmation_code = $confirmation_code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      return $this->from('app.mailer01@gmail.com')
        ->view('emails.register');
    }
}
