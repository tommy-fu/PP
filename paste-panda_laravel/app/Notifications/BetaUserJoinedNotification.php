<?php

namespace App\Notifications;

use App\Domain\Users\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class BetaUserJoinedNotification extends Notification
{
    use Queueable;

    private User $user;
	
	/**
	 * Create a new notification instance.
	 *
	 * @param $user
	 */
    public function __construct($user)
    {
	    $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['slack'];
    }

    public function toSlack($notifiable)
    {
        return (new SlackMessage)
            ->from('Pastepanda', ':panda_face:')
            ->to('#beta')
            ->content($this->user->first_name . ' ' . $this->user->last_name . ' has now joined the BETA!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
