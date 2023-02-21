<?php

namespace App\Actions;

use App\Domain\Webflow\ActionItemGroup;
use App\Domain\Webflow\ActionItemMove;
use App\Domain\Webflow\ActionItemOpacity;
use App\Domain\Webflow\ActionItemRotate;
use App\Domain\Webflow\ActionItemStyleBackground;
use App\Domain\Webflow\ActionItemTextColor;
use App\Domain\Webflow\ActionItemTransformScale;
use App\Domain\Webflow\WebflowAnimation;
use App\Http\Controllers\ActionItemBorder;

class CreateWebflowAnimation
{
	private $actionTypeIds = [
		'TRANSFORM_MOVE' => ActionItemMove::class,
		'STYLE_OPACITY' => ActionItemOpacity::class,
		'TRANSFORM_ROTATE' => ActionItemRotate::class,
		'TRANSFORM_SCALE' => ActionItemTransformScale::class,
		'STYLE_BORDER' => ActionItemBorder::class,
		'STYLE_TEXT_COLOR' => ActionItemTextColor::class,
		'STYLE_BACKGROUND_COLOR' => ActionItemStyleBackground::class,
		'GENERAL_DISPLAY' => ActionItemDisplay::class,
	];
	
	public function execute($file)
	{
		$file = file_get_contents(public_path($file . '.json'));
		
		$json = json_decode($file, true);
		
		$webflowAnimation = new WebflowAnimation();
		
		$animations = $json['actionLists'];

//        $lastDurationTime = 0;
		
		$lastActionItem = null;
		
		foreach ($animations as $animation) {
			
			$lastDurationTime = 0;
			
			
			$title = $animation['title'];

//            dd($animations);
			$useFirstGroupAsInitialState = isset($animation['useFirstGroupAsInitialState']) ? $animation['useFirstGroupAsInitialState'] : false;
			
			
			if (isset($animation['continuousParameterGroups'])) {
				foreach ($animation['continuousParameterGroups'] as $continuousParameterGroup) {
					foreach ($continuousParameterGroup['continuousActionGroups'] as $key => $continuousActionGroups) {
//						foreach ($continuousActionGroups['actionGroups'] as $key => $actionItemGroup) {
						$object = new ActionItemGroup();
						
						$object->setKeyframe($continuousActionGroups['keyframe']);
						
						$object->setTitle($title);
						
						if ($key == 0) $object->setIsInitial(true);
						
						$object->setStartTime($lastDurationTime);
						
						if ($key == 0 && $useFirstGroupAsInitialState) {
							$object->setIsInitial(true);
						}
						
						$actions = collect($continuousActionGroups['actionItems'])
							->map(function ($action) use ($lastDurationTime, $continuousActionGroups) {
								if (isset($this->actionTypeIds[$action['actionTypeId']])) {
									$item = new $this->actionTypeIds[$action['actionTypeId']]($action);
									$item->setStartTime($lastDurationTime);
									$item->setKeyframe($continuousActionGroups['keyframe']);
									
									return $item;
								}
							});
						
						$object->setActions($actions);
						
						$lastActionItem = $object->getActions()->last();
						
						$lastDurationTime = $lastActionItem->getStartTime() + $lastActionItem->getDelay() + $lastActionItem->getDuration();
						
						$webflowAnimation->addGroup($object);
					}
//					}
				}
			}
			
			if (isset($animation['actionItemGroups'])) {
				foreach ($animation['actionItemGroups'] as $key => $actionItemGroup) {
					$object = new ActionItemGroup();
					
					$object->setTitle($title);
					
					if ($key == 0) $object->setIsInitial(true);
					
					$object->setStartTime($lastDurationTime);
					
					if ($key == 0 && $useFirstGroupAsInitialState) {
						$object->setIsInitial(true);
					}
					
					$actions = collect($actionItemGroup['actionItems'])
						->map(function ($action) use ($lastDurationTime) {
							if (isset($this->actionTypeIds[$action['actionTypeId']])) {
								$item = new $this->actionTypeIds[$action['actionTypeId']]($action);
								$item->setStartTime($lastDurationTime);
								
								return $item;
							}
						});
					
					$object->setActions($actions);
					
					$lastActionItem = $object->getActions()->last();
					
					$lastDurationTime = $lastActionItem->getStartTime() + $lastActionItem->getDelay() + $lastActionItem->getDuration();
					
					$webflowAnimation->addGroup($object);
				}
			}
		}

//        dd($webflowAnimation->getActionGroups()->toArray());
		
		return $webflowAnimation;
	}
}
