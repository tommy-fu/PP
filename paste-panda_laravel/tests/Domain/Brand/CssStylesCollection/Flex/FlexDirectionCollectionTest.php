<?php

namespace Tests\Domain\Brand\CssStylesCollection\Flex;

use App\Domain\Brand\CssStylesCollection\Flex\FlexDirectionCollection;
use App\Domain\ColorThemes\Elements\Utility\Flex\FlexDirection;
use PHPUnit\Framework\TestCase;

class FlexDirectionCollectionTest extends TestCase
{
	
	/** @test */
	
	function it_can_create_correct_css_styles() {
		$collection = FlexDirectionCollection::getCollection();
		
		$this->assertEquals(FlexDirection::class, FlexDirectionCollection::$model);
		$this->assertEquals('is-flex-direction-', FlexDirectionCollection::$prefix);
		
		$arr = $collection->toArray();
		
		$this->assertEquals('.is-flex-direction-row', $arr[0]->getSelector());
	}
}
