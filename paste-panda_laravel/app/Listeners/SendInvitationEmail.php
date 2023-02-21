<?php

namespace App\Listeners;

use App\Events\UserInvited;
use App\Mail\PasswordResetMail;
use App\Mail\UserInvitationEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Junaidnasir\Larainvite\Events\Invited;

class SendInvitationEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
	
	/**
	 * Handle the event.
	 *
	 * @param $invitation
	 * @return void
	 */
    public function handle($invitation)
    {
	    Mail::to($invitation->invitation->email)
		    ->queue(new UserInvitationEmail($invitation));
    }
}
