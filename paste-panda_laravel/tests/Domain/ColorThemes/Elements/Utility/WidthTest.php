<?php

namespace Tests\Domain\ColorThemes\Elements\Utility;

use App\Domain\ColorThemes\Elements\Utility\Width;
use PHPUnit\Framework\TestCase;

class WidthTest extends TestCase
{
	
	/** @test */
	
	function it_can_retrieve_correct_values() {
		$cssStyle = Width::make('test-width', '50px');
		
		$this->assertEquals('50px', $cssStyle->getStyleByKey('width'));
		$this->assertEquals('.test-width', $cssStyle->getSelector());
	}
}
