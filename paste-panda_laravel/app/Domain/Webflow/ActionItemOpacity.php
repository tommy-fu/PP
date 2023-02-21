<?php


namespace App\Domain\Webflow;


/**
 * @property mixed value
 */
class ActionItemOpacity extends AbstractActionItem implements ActionItem
{
	
	private $value;
	
	public function __construct($actionItem)
	{
		parent::__construct($actionItem);
		
		$this->value = $actionItem['config']['value'];
	}
	
	public function getValue(){
		return $this->value ?? null;
	}
	
	
	public function getJS(): string
	{
		return 'opacity = ' . $this->value;
	}
}
