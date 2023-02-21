<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordResetMail extends Mailable
{
    use Queueable, SerializesModels;
	
	private $token;
	
	/**
	 * Create a new message instance.
	 *
	 * @param $token
	 */
    public function __construct($token)
    {
        //
	    $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.reset_password_email', [
        	'token' => $this->token
        ]);
    }
}
