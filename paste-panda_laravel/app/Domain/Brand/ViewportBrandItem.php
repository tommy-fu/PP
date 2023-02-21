<?php


namespace App\Domain\Brand;


class ViewportBrandItem
{
	
	private array $values;
	
	public function __construct(array $array)
	{
		$this->values = $array;
	}
	
	public function find($var){
		
		if (isset($this->values[$var])) {
			return $this->values[$var];
		}
		
		return null;
	}
}
