<?php

namespace App\Domain\Webflow;

class ActionItemRotate extends AbstractActionItem implements ActionItem
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
    private $xValue;
    /**
     * @var mixed
     */
    private $yValue;
    /**
     * @var mixed
     */
    private $zValue;

    public function __construct($actionItem)
    {
    
    	parent::__construct($actionItem);

        if (isset($actionItem['config']['xValue'])) {
            $this->xValue = $actionItem['config']['xValue'];
        }
        if (isset($actionItem['config']['yValue'])) {
            $this->yValue = $actionItem['config']['yValue'];
        }
        if (isset($actionItem['config']['zValue'])) {
            $this->zValue = $actionItem['config']['zValue'];
        }

        $this->xUnit = strtolower($actionItem['config']['xUnit']);
        $this->yUnit = strtolower($actionItem['config']['yUnit']);
        $this->zUnit = strtolower($actionItem['config']['zUnit']);
    }
    

    public function getJS() : string
    {
        return 'rotateX(' . $this->xValue . $this->xUnit . ') rotateY(' . $this->yValue . $this->yUnit . ') rotateZ(' . $this->zValue . $this->zUnit . ') skew(0deg, 0deg)';
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
	
	/**
	 * @return mixed
	 */
	public function getZValue()
	{
		return $this->zValue ?? null;
	}
}
