<?php


namespace App\Actions;


use App\Domain\Webflow\AbstractActionItem;

class ActionItemDisplay extends AbstractActionItem
{
	/**
	 * @var mixed
	 */
	private $value;
	
	public function __construct($actionItem)
	{
		parent::__construct($actionItem);
		
//		dd($actionItem);
		
		$this->value = $actionItem['config']['value'];
	}
	
	function getJS(): string
	{
		// TODO: Implement getJS() method.
	}
	
	/**
	 * @return mixed
	 */
	public function getValue()
	{
		return $this->value;
	}
}
