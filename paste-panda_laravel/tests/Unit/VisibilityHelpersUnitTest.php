<?php

namespace Tests\Unit;

use App\Domain\Brand\CssStylesCollection\ResponsiveUtilityClasses\DisplayUtilityClasses;
use Tests\DbTestCase;

class VisibilityHelpersUnitTest extends DbTestCase
{
	
	
	/** @test */
	public function it_contains_correct_flex_direction_classes()
	{
		
		$this->markTestSkipped();
		
		$flexHelpers = new DisplayUtilityClasses();
		
		$flexGrow = $flexHelpers->getUtilityClasses();
		
		$res = $flexGrow->map(function($cssStyle){
			return $cssStyle->getSelector();
		});
		
		$this->assertCount(6, $res);
		
		$this->assertContains('is-block', $res);
		$this->assertContains('is-flex', $res);
		$this->assertContains('is-inline', $res);
		$this->assertContains('is-inline-block', $res);
		$this->assertContains('is-inline-flex', $res);
		$this->assertContains('is-hidden', $res);
	}
	
}
