<?php

namespace App\Providers;

use App\Listeners\SendInvitationEmail;
use App\Listeners\AddToElastic;
use App\Notifications\SendUserInvitationNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Junaidnasir\Larainvite\Events\Invited;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
	    Invited::class => [
		    SendInvitationEmail::class,
	    ],
	    AddToElastic::class => [
		    SendInvitationEmail::class,
	    ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
