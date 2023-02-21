<?php


namespace App\Domain\Webflow;


class ActionItemMove extends AbstractActionItem implements ActionItem
{

	private $xUnit;
	/**
	 * @var mixed
	 */
	private $yUnit;
	/**
	 * @var mixed
	 */
	private $zUnit;
	/**
	 * @var mixed
	 */
	private $xValue = null;
	/**
	 * @var mixed
	 */
//	private $yValue = 0;
	private $yValue = null;

	
	public function __construct($actionItem)
	{
		parent::__construct($actionItem);
		
		if (isset($actionItem['config']['xValue'])) {
			$this->xValue = $actionItem['config']['xValue'];
		}
		
		if (isset($actionItem['config']['yValue'])) {
			$this->yValue = $actionItem['config']['yValue'];
		}

		$this->xUnit = $actionItem['config']['xUnit'];
		$this->yUnit = $actionItem['config']['yUnit'];
		$this->zUnit = $actionItem['config']['zUnit'];
	}
	
	
	function getJS() : string
	{
		return 'translate3d(' . $this->xValue . strtolower($this->xUnit) . ', ' . strtolower($this->yValue)  . $this->yUnit . ', 1px)';
	}
	
	/**
	 * @return mixed
	 */
	public function getXValue()
	{
		return $this->xValue ?? null;
	}
	
	/**
	 * @return mixed
	 */
	public function getYValue()
	{
		return $this->yValue ?? null;
	}
}
