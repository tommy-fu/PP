<?php

namespace Tests\Services;

use App\Domain\Brand\CssStyleBuilder\CssStyle;
use App\Services\MediaQueriesService;
use PHPUnit\Framework\TestCase;

class MediaQueriesServiceTest extends TestCase
{
	
	public function setUp() : Void
	{
		$this->markTestSkipped('Must be revisited.');
	}
	
	/** @test */
	
	function it_can_get_base_css() {
		
		$cssStyles = [];
		
		$cssStyle = new CssStyle('has-text-white', [
			[
				'key' => 'color',
				'value' => '#fff'
			]
		]);
		
		$cssStyles[] = $cssStyle;
		
		$res = '.has-text-white {' . PHP_EOL;
		$res .= 'color: #fff;' . PHP_EOL;
		
		$res .= '}' . PHP_EOL;
		
		$this->assertEquals($res, MediaQueriesService::getCss('', $cssStyles));
	}
	
	/** @test */
	
	function it_can_get_css_for_tablet() {
		
		$cssStyles = [];
		
		$cssStyle = new CssStyle('has-text-white', [
			[
				'key' => 'color',
				'value' => '#fff'
			]
		]);
		
		$cssStyle->addTabletStyle('color', '#fff');
		
		$cssStyles[] = $cssStyle;
		
		$res = '@media screen and (min-width:' . MediaQueriesService::TABLET . 'px)' . ' {' . PHP_EOL;
		
		$res .= '.has-text-white {' . PHP_EOL;
		$res .= 'color: #fff;' . PHP_EOL;
		
		$res .= '}' . PHP_EOL;
		$res .= '}' . PHP_EOL;
		
		$this->assertEquals($res, MediaQueriesService::getCss('tablet', $cssStyles));
	}
	
	/** @test */
	
	
	function it_can_get_css_for_desktop() {
		
		$cssStyles = [];
		
		$cssStyle = new CssStyle('has-text-white', [
			[
				'key' => 'color',
				'value' => '#fff'
			]
		]);
		
		$cssStyle->addDesktopStyle('color', '#fff');
		
		$cssStyles[] = $cssStyle;
		
		$res = '@media screen and (min-width:' . MediaQueriesService::DESKTOP . 'px)' . ' {' . PHP_EOL;
		
		$res .= '.has-text-white {' . PHP_EOL;
		$res .= 'color: #fff;' . PHP_EOL;
		
		$res .= '}' . PHP_EOL;
		$res .= '}' . PHP_EOL;
		
		$this->assertEquals($res, MediaQueriesService::getCss('desktop', $cssStyles));
	}
	
}
