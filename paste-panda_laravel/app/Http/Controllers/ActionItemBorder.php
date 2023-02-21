<?php


namespace App\Http\Controllers;


use App\Domain\Webflow\AbstractActionItem;

class ActionItemBorder extends AbstractActionItem
{
	
	/**
	 * @var mixed
	 */
	private $bValue;
	/**
	 * @var mixed
	 */
	private $rValue;
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
		
//		dd($actionItem);
		$this->rValue = $actionItem['config']['rValue'];
		$this->bValue = $actionItem['config']['bValue'];
		$this->gValue = $actionItem['config']['gValue'];
		$this->aValue = $actionItem['config']['aValue'];
	}
	
	function getJS(): string
	{
		// TODO: Implement getJS() method.
	}
	
	/**
	 * @return mixed
	 */
	public function getBValue()
	{
		return $this->bValue;
	}
	
	/**
	 * @param mixed $bValue
	 */
	public function setBValue($bValue): void
	{
		$this->bValue = $bValue;
	}
	
	/**
	 * @return mixed
	 */
	public function getRValue()
	{
		return $this->rValue;
	}
	
	/**
	 * @param mixed $rValue
	 */
	public function setRValue($rValue): void
	{
		$this->rValue = $rValue;
	}
	
	/**
	 * @return mixed
	 */
	public function getGValue()
	{
		return $this->gValue;
	}
	
	/**
	 * @param mixed $gValue
	 */
	public function setGValue($gValue): void
	{
		$this->gValue = $gValue;
	}
	
	/**
	 * @return mixed
	 */
	public function getAValue()
	{
		return $this->aValue;
	}
	
	/**
	 * @param mixed $aValue
	 */
	public function setAValue($aValue): void
	{
		$this->aValue = $aValue;
	}
}
