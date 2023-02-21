<?php

namespace Tests\Services;

use App\Services\CssServices;
use PHPUnit\Framework\TestCase;

class CssServicesTest extends TestCase
{
	
	/** @test */
	
	function it_can_get_css_values() {
		
		self::assertEquals('color: #000;' . PHP_EOL, CssServices::getCssStyle('color', '#000'));
	}
	
	/** @test */
	
	function it_can_add_zero_as_value() {
		
		self::assertEquals('left: 0;' . PHP_EOL, CssServices::getCssStyle('left', '0'));
	}
}
