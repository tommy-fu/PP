<?php


namespace App\Domain\Webflow;


class ActionItemStyleBackground extends AbstractActionItem implements ActionItem
{
	/**
	 * @var mixed
	 */
	private $rValue;
	/**
	 * @var mixed
	 */
	private $bValue;
	/**
	 * @var mixed
	 */
	private $gValue;
	/**
	 * @var mixed
	 */
	private $aValue;
	
	
	public function __construct($actionItem)
	{
		parent::__construct($actionItem);
		
		if (isset($actionItem['config']['xValue'])) {
			$this->xValue = $actionItem['config']['xValue'];
		}
		
		if (isset($actionItem['config']['yValue'])) {
			$this->yValue = $actionItem['config']['yValue'];
		}

		$this->rValue = $actionItem['config']['rValue'];
		$this->bValue = $actionItem['config']['bValue'];
		$this->gValue = $actionItem['config']['gValue'];
		$this->aValue = $actionItem['config']['aValue'];
	}
	
	
	function getJS() : string
	{
		return 'translate3d(' . $this->xValue . strtolower($this->xUnit) . ', ' . strtolower($this->yValue)  . $this->yUnit . ', 1px)';
	}
	
	/**
	 * @return mixed
	 */
	public function getRValue()
	{
		return $this->rValue;
	}
	
	/**
	 * @return mixed
	 */
	public function getBValue()
	{
		return $this->bValue;
	}
	
	/**
	 * @return mixed
	 */
	public function getGValue()
	{
		return $this->gValue;
	}
	
	/**
	 * @return mixed
	 */
	public function getAValue()
	{
		return $this->aValue;
	}
}
