<?php


namespace App\JavaScriptBuilder;


use App\JavaScriptEvent;
use Illuminate\Support\Collection;

class JavaScriptBuilder
{
	
	private $code = '';
	private $events;
	
	public function __construct()
	{
		$this->events = new Collection();
	}
	
	public function addEvent(JavaScriptEvent $event){
		$this->events->add($event);
	}
	
	public function getCode(){
		return $this->events->reduce(function($carry, $event){
			return $carry . $event->getCode();
		});
		
	}
}
