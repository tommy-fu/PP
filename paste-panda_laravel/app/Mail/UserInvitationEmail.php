<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserInvitationEmail extends Mailable
{
	use Queueable, SerializesModels;
	
	private $invitation;
	
	/**
	 * Create a new message instance.
	 *
	 * @param $invitation
	 */
	public function __construct($invitation)
	{
		//
		$this->invitation = $invitation;
	}

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
	    return $this->view('email.user_invitation_email', [
		    'invitation' => $this->invitation->invitation,
	    ]);
    }
}
