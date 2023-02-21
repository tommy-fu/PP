<?php


namespace App\Domain\Webflow;


/**
 * @property mixed value
 */
class ActionItemTransformScale extends AbstractActionItem implements ActionItem
{

	/**
	 * @var mixed
	 */
	private $xValue;
	/**
	 * @var mixed
	 */
	private $yValue;
	
	
	public function __construct($actionItem)
	{
		parent::__construct($actionItem);
		
		$this->xValue = $actionItem['config']['xValue'];
		$this->yValue = $actionItem['config']['yValue'];
	}

	
	public function getJS() : string {
		return 'scale3d(' . $this->xValue . ', ' . $this->yValue . ', 1)';
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
