<?php

namespace App\Domain\Webflow;

use Illuminate\Support\Collection;

class WebflowAnimation
{
	/**
	 * @var array
	 */
	private Collection $actionGroups;
	
	public function __construct()
	{
		$this->actionGroups = new Collection();
	}
	
	public function addGroup($actionGroup)
	{
		$this->actionGroups[] = $actionGroup;
	}
	
	/**
	 * @return array
	 */
	public function getActionGroups(): Collection
	{
		return $this->actionGroups;
	}
	
	public function getSelectors()
	{
		$mergedActionGroups = $this->actionGroups
			->filter(function ($actionGroup) {
				return $actionGroup->isInitial() == false;
			})
			->groupBy(function ($actionGroup) {
				return $actionGroup->getTitle();
			})
			->map(function ($item) {
				return $item->flatMap(function ($group) {
					return $group->getActions();
					//						->filter(function ($actionGroup) {
//						return $actionGroup->isInitial() == false;
//					});
				})
					->groupBy(function ($action) {
						return $action->getSelector();
					});
			});
		
		//		dd($mergedActionGroups);
		$result = new Collection();
//		dd($mergedActionGroups);
		
		foreach ($mergedActionGroups as $key => $actionGroup) {
			$results = [];
			
			$previousAction = null;
			foreach ($actionGroup as $actionKey => $mappedAction) {
				//				if ($actionKey == '6078467da4b5d4439eb23a1b|747fec7e-0ec0-4ab6-ac82-c66c1c1736cf') dd($mergedActionGroups);
				$transformer = new AnimationTransformer($actionKey);
				
				foreach ($mappedAction as $item) {
					$transformer->addAnimations($item);
				}
				
				$results[] = $transformer;
			}
			
			$result->add([
				'title' => $key,
				'items' => $results,
			]);
		}
		
		return $result;
	}
	
	public function getAnimationBySelector($selector)
	{
	}
}
