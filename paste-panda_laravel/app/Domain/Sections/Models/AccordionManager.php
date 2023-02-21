<?php


namespace App\Domain\Sections\Models;


class AccordionManager
{
	private $id = 1;
	
	public function getId(){
		return $this->id;
	}
	
	public function increment(){
		$this->id += 1;
	}
	
	public function reset(){
		$this->id = 1;
	}
}
