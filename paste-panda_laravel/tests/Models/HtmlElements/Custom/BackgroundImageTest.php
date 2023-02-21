<?php

namespace Tests\Models\HtmlElements\Custom;

use App\Domain\Sections\HtmlElementsHelper;
use App\Domain\Sections\HtmlTags\Special\BackgroundImage;
use App\Services\HtmlToJsonConverter;
use PHPUnit\Framework\TestCase;

class BackgroundImageTest extends TestCase
{
	
	public function setUp() : Void
	{
		parent::setUp();
		$this->markTestSkipped('Must be revisited.');
	}
	
	/** @test */
	
	function it_can_render_a_background_image_component()
	{
		
		$config = [];
		
		$converter = new HtmlToJsonConverter();
		
		$node = json_decode($converter->convertHtml('<background-image src="http://test.se"></background-image>'), true);
		
		$htmlElement = new BackgroundImage($node, $config, 0);
		
		$html = $htmlElement->getHtml();
		
		$this->assertStringContainsString('<div', $html);
		$this->assertStringContainsString('class="is-relative has-height-197 has-height-228-tablet has-height-350-desktop is-clipped is-fullwidth"', $html);
		$this->assertStringContainsString('background: url(\'http://test.se\')', $html);
		$this->assertStringContainsString('<div class="is-overlay">', $html);
		$this->assertStringContainsString('</div>', $html);
	}
	
	
	/** @test */
	
	function it_show_have_overlay_as_its_first_child()
	{
		
		$config = [];
		
		$converter = new HtmlToJsonConverter();
		
		$node = json_decode($converter->convertHtml('<background-image src="http://test.se"><div class="test">Test</div></background-image>'), true);
		
		$htmlElement = new BackgroundImage($node, $config, 0);
		
		$html = $htmlElement->getHtml();
		
		$node = json_decode($converter->convertHtml($html), true);
		
		$children = collect($node['children'])
			->filter(function ($child){
				return $child['element'] != '#text';
			});
		
		
		$overlayHtml = HtmlElementsHelper::lookup($children->first(), $config, 0)->getHtml();
		
		$this->assertStringContainsString('<div class="is-overlay">', $overlayHtml);
		$this->assertStringContainsString('</div>', $html);
		
		
		$lastHtml = HtmlElementsHelper::lookup($children->last(), $config, 0)->getHtml();
		
		$this->assertStringContainsString('<div class="test">', $lastHtml);
		$this->assertStringContainsString('</div>', $lastHtml);
		
	}
	
}
