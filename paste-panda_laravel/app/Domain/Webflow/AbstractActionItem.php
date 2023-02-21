<?php


namespace App\Domain\Webflow;


abstract class AbstractActionItem
{
	
	private $delay;


	private $actionType;

	private $easing = '';
	
	private $duration;
	
	private $startTime = 0;
	
	private $keyframe = -1;

	private $selector;
	
	private bool $isInitial = false;
	/**
	 * @var mixed
	 */
	private $id;
	
	
	public function getDelay()
	{
		return $this->delay;
	}
	
	public function getDuration()
	{
		return $this->duration;
	}
	
	public function getSelector()
	{
		return $this->selector;
	}
	
	public function getId()
	{
		return $this->id;
	}
	
	public function getEasing()
	{
		return $this->easing;
	}
	
	
	public function __construct($actionItem)
	{
		$this->actionType = $actionItem['actionTypeId'];
		
		$this->id = $actionItem['id'];
		
		if (isset($actionItem['config']['target']['selector'])) {
			$this->selector = $actionItem['config']['target']['selector'];
		} else {
			$this->selector = $actionItem['config']['target']['id'];
		}
		
		if (isset($actionItem['config']['easing'])) {
			$this->easing = $actionItem['config']['easing'];
//			if ($actionItem['config']['easing'] == 'outBack') $this->easing = 'cubic-bezier(0.34, 1.56, 0.64, 1)';
		}
		
		$this->delay = $actionItem['config']['delay'];
		
		$this->duration = $actionItem['config']['duration'];
	}
	
	abstract function getJS() : string;
	
	/**
	 * @return mixed
	 */
	public function getActionType()
	{
		return $this->actionType;
	}
	
	/**
	 * @param mixed $delay
	 */
	public function setDelay($delay): void
	{
		$this->delay = $delay;
	}
	
	/**
	 * @return bool
	 */
	public function isInitial(): bool
	{
		return $this->isInitial;
	}
	
	/**
	 * @param bool $isInitial
	 */
	public function setIsInitial(bool $isInitial): void
	{
		$this->isInitial = $isInitial;
	}
	
	/**
	 * @return mixed
	 */
	public function getStartTime()
	{
		return (int)$this->startTime;
	}
	
	/**
	 * @param mixed $startTime
	 */
	public function setStartTime($startTime): void
	{
		$this->startTime = $startTime;
	}
	
	/**
	 * @return int
	 */
	public function getKeyframe(): int
	{
		return $this->keyframe;
	}
	
	/**
	 * @param int $keyframe
	 */
	public function setKeyframe(int $keyframe): void
	{
		$this->keyframe = $keyframe;
	}
	
}
