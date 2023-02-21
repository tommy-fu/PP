<?php

namespace Tests\Models\HtmlElements\Custom;

use App\Domain\Sections\HtmlTags\Special\Badge;
use App\Services\HtmlToJsonConverter;
use PHPUnit\Framework\TestCase;

class BadgeTest extends TestCase
{
	
	
	/** @test */
	
	function it_can_render_a_badge() {
		
		$this->markTestSkipped();
		
		$config = [];
		
		$converter = new HtmlToJsonConverter();
		
//		$node = json_decode($converter->convertHtml('<badge>This is a badge</badge>'), true);
		$node = json_decode($converter->convertHtml('<badge>This is a badge</badge>'), true);
		
		$htmlElement = new Badge($node, $config, 0);
		
		$html = $htmlElement->getHtml();
		
		$this->assertStringContainsString('<div', $html);
		$this->assertStringContainsString('class="badge"', $html);
		$this->assertStringContainsString('This is a badge', $html);
		$this->assertStringContainsString('</div>', $html);
//		$this->assertStringContainsString('</div>', $html);
	}
	
	
	/** @test */
	
	function it_can_render_a_badge_with_a_additional_classes() {
		
		$this->markTestSkipped();
		
		$config = [];
		
		$converter = new HtmlToJsonConverter();

//		$node = json_decode($converter->convertHtml('<badge>This is a badge</badge>'), true);
		$node = json_decode($converter->convertHtml('<badge class="is-primary is-large">This is a badge</badge>'), true);
		
		$htmlElement = new Badge($node, $config, 0);
		
		$html = $htmlElement->getHtml();
		
		$this->assertStringContainsString('<div', $html);
		$this->assertStringContainsString('class="badge is-primary is-large"', $html);
		$this->assertStringContainsString('This is a badge', $html);
		$this->assertStringContainsString('</div>', $html);
	}
}
