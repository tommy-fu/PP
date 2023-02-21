<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SetCardVariables extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scheme:card';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $json = json_decode(file_get_contents(public_path('/theme.json')), true);
	
	    foreach ($json as $key => $value) {
		    if(isset($json['card_' . $key])) {
		    	if( $json['card_' . $key] != $json[$key]) dd($key);
		    	$json['card_' . $key] = $value;
		    }
        }
	    
	    file_put_contents(public_path('scheme-result.json'), json_encode($json));
//	    dd($json);
    }
}
