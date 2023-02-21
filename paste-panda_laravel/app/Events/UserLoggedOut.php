<?php

namespace App\Events;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class UserLoggedOut
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
	
	private $type;
	private $data;
	
	/**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($data, $type)
    {
    	$this->data = $data;
    	$this->type = $type;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
