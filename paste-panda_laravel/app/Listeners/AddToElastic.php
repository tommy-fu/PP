<?php

namespace App\Listeners;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

class AddToElastic
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
	   
    	$data = $event->data;
    	$type = $event->type;
    	
	    $endpoint = env('ELASTIC_ENDPOINT') . '/_bulk';
	
	    $client = new Client();
	
	    $res = [];
	
	    $res[] = array_merge($data, [
		    'session.id' => session()->getId(),
		    'timestamp' => Carbon::now()->toIso8601String(),
		    'event.type' => $type,
	    ]);
	    if (! Auth::guest()) {
		    $res[] = array_merge($res, [
			    'user.id' => Auth::user()->id,
		    ]);
	    }
	
	    $data = [];
	
	    foreach ($res as $result) {
		    $data[] = json_encode(['index' => ['_index' => env('ELASTIC_INDEX')],
		    ]);
		
		    $data[] = json_encode($result);
	    }
	
	    $data = implode("\n", $data);
	
	    $client->post($endpoint, [
		    'headers' => ['Content-Type' => 'application/json'],
		    'body' => $data . "\n",
	    ]);
    }
}
