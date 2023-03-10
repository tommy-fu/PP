<?php


namespace Tests;


use App\Actions\CreateWebflowAnimation;
use App\Domain\Webflow\ActionItemGroup;
use App\Domain\Webflow\ActionItemMove;
use App\Domain\Webflow\ActionItemOpacity;
use App\Domain\Webflow\ActionItemRotate;
use App\Domain\Webflow\ActionItemTransformScale;
use App\Domain\Webflow\WebflowAnimation;
use Illuminate\Support\Collection;

class WebflowConverterTest extends TestCase
{
	
	protected function setUp(): void
	{
		parent::setUp(); // TODO: Change the autogenerated stub
		$this->markTestSkipped();
	}
	
	/** @test */
	
	function it_can_convert_webflow_to_animations()
	{
		$file = file_get_contents('tests/webflow_animations.json');
		
		$json = json_decode($file, true);
		
		
		$actions = $json['actionLists'];
		
		
		$this->assertCount(8, $actions);
	}
	
	
	/** @test */
	
	function it_can_retrieve_the_values()
	{
		$file = file_get_contents('tests/webflow_animations.json');
		
		$json = json_decode($file, true);
		
		
		$actions = $json['actionLists'];
		
		$action = $actions['a-8'];
		
		$actionItems = new Collection();
		
		$webflowAnimation = new WebflowAnimation();
		
		foreach ($action['actionItemGroups'] as $actionItemGroup) {
			$actionGroup = new ActionItemGroup();
			foreach ($actionItemGroup['actionItems'] as $actionItem) {
				if ($actionItem['actionTypeId'] == 'TRANSFORM_MOVE') {
					$item = new ActionItemMove($actionItem);
					$actionItems->add($item);
					$actionGroup->addAction($item);
				}
				
				if ($actionItem['actionTypeId'] == 'STYLE_OPACITY') {
					$item = new ActionItemOpacity($actionItem);
					$actionItems->add($item);
					$actionGroup->addAction($item);
				}
				
				if ($actionItem['actionTypeId'] == 'TRANSFORM_ROTATE') {
					$item = new ActionItemRotate($actionItem);
					$actionItems->add($item);
					$actionGroup->addAction($item);
				}
				
				if ($actionItem['actionTypeId'] == 'TRANSFORM_SCALE') {
					$item = new ActionItemTransformScale($actionItem);
					$actionItems->add($item);
					$actionGroup->addAction($item);
				}
			}
			$webflowAnimation->addGroup($actionGroup);
		}

//		dd($webflowAnimation->getActionGroups()->nth(3));
		$this->assertEquals('translate3d(0px, 0px, 0px) scale3d(1, 1, 1) rotateX(0deg) rotateY(0deg) rotateZ(0deg) skew(0deg, 0deg)', $webflowAnimation->getActionGroups()->values()->get(1)->getJS());


//		dd($webflowAnimation->getSelectors());
		$opacityItem = $webflowAnimation->getActionGroups()->first()
			->getActions()
			->filter(function ($action) {
				return get_class($action) == ActionItemOpacity::class;
			})->first();
		
		$this->assertEquals('opacity = 1', $opacityItem->getJS());
		
		$scaleItem = $webflowAnimation->getActionGroups()->first()
			->getActions()
			->filter(function ($action) {
				return get_class($action) == ActionItemTransformScale::class;
			})->first();
		
		$this->assertEquals('scale3d(0, 0, 1)', $scaleItem->getJS());
		
		$rotationItem = $webflowAnimation->getActionGroups()->first()
			->getActions()
			->filter(function ($action) {
				return get_class($action) == ActionItemRotate::class;
			})->first();
		
		$this->assertEquals('rotateX(0deg) rotateY(0deg) rotateZ(-8deg) skew(0deg, 0deg)', $rotationItem->getJS());
		
		$this->assertCount(3, $webflowAnimation->getActionGroups());
		$this->assertCount(9, $actionItems);
//		$this->assertEquals(500, $action);
	}
	
	/** @test
	 * @param CreateWebflowAnimation $createWebflowAnimation
	 */
	
	function it_can_retrieve_correct_timings()
	{
		$createWebflowAnimation = new CreateWebflowAnimation();
		$webflowAnimation = $createWebflowAnimation->execute('custom_test_webflow_animations');
		
		
//		dd($webflowAnimation->getSelectors()[0]['items']);
		$items = $webflowAnimation->getSelectors()[0]['items'];

		$this->assertEquals(0, $this->findActionById($items, "a-n")->getStartTime());
		$this->assertEquals(0, $this->findActionById($items, "a-n")->getDelay());
		$this->assertEquals(500, $this->findActionById($items, "a-n")->getDuration());
//		dd( $randomAction[0]);
		$this->assertEquals(500, $this->findActionById($items, "a-n2")->getStartTime());
		$this->assertEquals(2200, $this->findActionById($items, "a-n2")->getDelay());
		$this->assertEquals(500, $this->findActionById($items, "a-n2")->getDuration());
		
		$this->assertEquals(3200, $this->findActionById($items, "a-n4")->getStartTime());
		$this->assertEquals(2200, $this->findActionById($items, "a-n4")->getDelay());
		$this->assertEquals(500, $this->findActionById($items, "a-n4")->getDuration());

		$this->assertEquals(5900, $this->findActionById($items, "a-n3")->getStartTime());
		$this->assertEquals(500, $this->findActionById($items, "a-n3")->getDuration());
	}
	
	private function findActionById($items, $id){
		return collect($items)
			->flatMap(function($item){
				return $item->getAnimations()
					->flatMap(function($animation){
						return $animation->getActions();
					});
			})
			->first(function($action) use($id){
				return $action->getId() == $id;
			});
	}
}
