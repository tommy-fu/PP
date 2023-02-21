<?php

namespace App\Domain\Webflow;

use App\Actions\ActionItemDisplay;
use App\Http\Controllers\ActionItemBorder;

class AnimationResult
{
	private string $transform;
	private $delay;
	private $duration;
	private $easing;
	private $opacity;
	private $selector;
	private $actionItems;
	private int $order;
	private $startTime;
//	private $lastItemDelay = 0;
	private int $lastStartTime;
	private bool $isFirstItem = false;
	
	/**
	 * AnimationResult constructor.
	 */
	public function __construct()
	{
	}
	
	public function setEasing($easing)
	{
		$this->easing = $easing;
	}
	
	public function setDuration($duration)
	{
		$this->duration = $duration;
	}
	
	public function setDelay($delay)
	{
		$this->delay = $delay;
	}
	
	public function setTransform(string $transform)
	{
		$this->transform = $transform;
	}
	
	public function getResult()
	{
		$res = '';
		$easingStr = $this->easing ? ' ' . $this->easing : '';
		$res .= 'element.style.transition = ' . "'" . $this->duration . 'ms' . $easingStr . "';" . PHP_EOL;
		//		$res .= 'element.style.transitionDelay = ' . "'" . $this->delay . 'ms' . "';" . PHP_EOL;
		if ($this->delay > 0) {
			$res .= 'element.style.transitionDelay = ' . "'" . $this->delay . 'ms' . "';" . PHP_EOL;
		}
		$res .= 'element.style.transform = ' . "'" . $this->transform . "'" . ';' . PHP_EOL;
		
		if ($this->opacity) {
			$res .= "element.style.opacity= '" . $this->opacity . "';" . PHP_EOL;
		}
		//		$res .= $this->getOpacityIfExists($animation['items']);
		$res .= PHP_EOL;
		
		return $res;
	}
	
	public function asGsap()
	{
		$array = [
			'duration' => $this->convertToSeconds($this->duration),
		];

//		if($this->lastStartTime == 0) $array['delay'] = $this->convertToSeconds($this->delay + $this->startTime);
//			else $array['delay'] = $this->convertToSeconds($this->delay + $this->lastStartTime);
//		$array['delay'] = $this->convertToSeconds($this->startTime - $this->lastStartTime);
//		$array['delay'] = $this->convertToSeconds($this->startTime - $this->lastStartTime);
//		if($this->isFirstItem){
			$array['delay'] = $this->convertToSeconds($this->startTime + $this->delay);
//		}
//		else{
//			$array['delay'] = $this->convertToSeconds($this->startTime - $this->lastStartTime + $this->delay);
//		}
//
//			else $array['delay'] = $this->convertToSeconds($this->startTime - $this->lastStartTime);
//		$array['startTime'] = $this->convertToSeconds($this->startTime);
//		$array['lastStartTime'] = $this->convertToSeconds($this->lastStartTime);
//		$array['delay'] = $this->convertToSeconds($this->delay + $this->lastStartTime);

//		if($this->selector == '#palette-1') dd($this);
		
		foreach ($this->actionItems as $key => $actionItem) {
			if (get_class($actionItem) == ActionItemMove::class) {
				if (!is_null($actionItem->getXValue())) {
					$array['css']['x'] = $actionItem->getXValue();
				}
				if (!is_null($actionItem->getYValue())) {
					$array['css']['y'] = $actionItem->getYValue();
				}
			}
			
			if (get_class($actionItem) == ActionItemOpacity::class) {
				if (!is_null($actionItem->getValue())) {
					$array['css']['opacity'] = $actionItem->getValue();
				}
			}
			
			if (get_class($actionItem) == ActionItemTransformScale::class) {
				if (!is_null($actionItem->getXValue())) {
					$array['css']['scaleX'] = $actionItem->getXValue();
				}
				if (!is_null($actionItem->getYValue())) {
					$array['css']['scaleY'] = $actionItem->getYValue();
				}
			}
			
			if (get_class($actionItem) == ActionItemRotate::class) {
				if (!is_null($actionItem->getXValue())) {
					$array['css']['rotationX'] = $actionItem->getXValue();
				}
				if (!is_null($actionItem->getYValue())) {
					$array['css']['rotationY'] = $actionItem->getYValue();
				}
				if (!is_null($actionItem->getZValue())) {
					$array['css']['rotationZ'] = $actionItem->getZValue();
				}
			}
			
			if (get_class($actionItem) == ActionItemStyleBackground::class) {
				$array['css']['background'] = 'rgba(' . $actionItem->getRValue() . ',' . $actionItem->getGValue() . ', ' . $actionItem->getBValue() . ')';
			}
			
			if (get_class($actionItem) == ActionItemTextColor::class) {
				$array['css']['color'] = 'rgba(' . $actionItem->getRValue() . ',' . $actionItem->getGValue() . ', ' . $actionItem->getBValue() . ')';
			}
			
			if (get_class($actionItem) == ActionItemDisplay::class) {
				if (!is_null($actionItem->getValue())) {
					$array['css']['display'] = $actionItem->getValue();
				}
			}
			
			
			if (get_class($actionItem) == ActionItemBorder::class) {
				$borderColor = '1px solid rgba(' . $actionItem->getRValue() . ', ' . $actionItem->getGValue() . ', ' . $actionItem->getBValue() . ', ' . $actionItem->getAValue() . ')';
				$array['css']['border'] = $borderColor;
			}
		}


//		if (isset($array['css'])) {
//			if (isset($array['rotationX'])) {
//				$array['css']['rotationX'] = $array['rotationX'];
//				unset($array['rotationX']);
//			}
//			if (isset($array['rotationY'])) {
//				$array['css']['rotationY'] = $array['rotationY'];
//				unset($array['rotationY']);
//			}
//
//			if (isset($array['rotationZ'])) {
//				$array['css']['rotationZ'] = $array['rotationZ'];
//				unset($array['rotationZ']);
//			}
//		}
		
		if ($this->getEasingInGsap()) {
			$array['ease'] = $this->getEasingInGsap();
		}
		
		$result = json_encode($array);
		
		//		if ($this->getEasingInGsap()) {
		//			$json = $result;
		//			$regex = '~"ease":("(.*)")~';
		//			$result = preg_replace($regex, '"ease": $2', $json);
		//		}
		
		//		return "gsap.to('" . '#' . $this->selector . "', " . json_encode($array) . ")";
//		return ".to('" . $this->selector . "', " . $result . ')' . PHP_EOL;
		return "gsap.to('" . $this->selector . "', " . $result . ')' . PHP_EOL;
	}
	
	public function getEasingInGsap()
	{
		//		if ($this->easing == 'outBack') return 'Back.easeOut()';
		if ($this->easing == 'outBack') {
			return 'back';
		}
		
		return null;
	}
	
	public function convertToSeconds($milliseconds)
	{
		return $milliseconds / 1000;
	}
	
	public function setOpacity($opacity)
	{
		$this->opacity = $opacity;
	}
	
	public function setSelector($selector)
	{
		$this->selector = $selector;
	}
	
	/**
	 * @param mixed $actionItems
	 */
	public function setActionItems($actionItems)
	{
		$this->actionItems = $actionItems;
	}
	
	public function setOrder(int $order)
	{
		$this->order = $order;
	}
	
	/**
	 * @return int
	 */
	public function getOrder(): int
	{
		return $this->order;
	}
	
	public function setStartTime($startTime)
	{
		$this->startTime = $startTime;
	}
	
	/**
	 * @return mixed
	 */
	public function getDelay()
	{
		return $this->delay;
	}
	
	/**
	 * @return mixed
	 */
	public function getStartTime()
	{
		return $this->startTime;
	}
	
	/**
	 * @return mixed
	 */
	public function getDuration()
	{
		return $this->duration;
	}
	
	public function getActions()
	{
		return $this->actionItems;
	}
	
	public function setLastStartTime(int $lastStartTime)
	{
		$this->lastStartTime = $lastStartTime;
	}
	
	/**
	 * @return int
	 */
	public function getLastStartTime(): int
	{
		return $this->lastStartTime;
	}
	
	/**
	 * @param bool $isFirstItem
	 */
	public function setIsFirstItem(bool $isFirstItem): void
	{
		$this->isFirstItem = $isFirstItem;
	}
}
