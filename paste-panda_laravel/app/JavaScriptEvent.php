<?php

namespace App;

class JavaScriptEvent
{
	const CLICK = 1;
	const HOVER = 2;
	
	private $identifier;
	private string $code;
	
	/**
	 * JavaScriptEvent constructor.
	 * @param $identifier
	 */
	public function __construct($identifier)
	{
		$this->identifier = $identifier;
		$this->code = 'document.getElementById("' . $this->identifier . '").addEventListener("' . 'click' . '", function(){' . PHP_EOL;
	}
	
	public function getCode()
	{
		return $this->code . PHP_EOL . '});' . PHP_EOL;
	}
	
	public function addCode($code)
	{
		$this->code .= $code;
		return $this;
	}
	
	
	public function addToggleVisibilityCode($identifier)
	{
		$this->code .= 'var x = document.getElementById("' . $identifier . '");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }' . PHP_EOL;
		
		return $this;
	}
	
	public function addDocumentElementById($variableName, $identifier)
	{
		return 'var ' . $variableName . ' = document.getElementById("' . $identifier . '");';
	}
	
	public function toggleClass($identifier, $className){
		$this->code .= 'document.getElementById("' . $identifier . '").classList.toggle("' . $className . '");';
	}
	
	public static function make($identifier) : self{
		
		return new static($identifier);
	}
}
