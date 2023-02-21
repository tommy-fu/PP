<?php

namespace Tests\Models\HtmlElements\Custom;

use App\Domain\Sections\HtmlTags\Avatar;
use App\Services\HtmlToJsonConverter;
use PHPUnit\Framework\TestCase;

class AvatarTest extends TestCase
{
	public function setUp() : Void{
		$this->markTestSkipped('Must be revisited.');
	}
	
	/** @test */
	
	function it_can_render_the_avatar_tag() {
		
		
		$config = [];
		
		$converter = new HtmlToJsonConverter();
		
		$node = json_decode($converter->convertHtml('<avatar/>'), true);

		$htmlElement = new Avatar($node, $config, 0);
		
		$html = $htmlElement->getHtml();
		
		$this->assertStringContainsString('<img', $html);
//		$this->assertStringContainsString('class="test-class"', $html);
		$this->assertStringContainsString('src="/images/avatars/profile.jpeg"', $html);
//		$this->assertStringContainsString('</div>', $html);
	}
	
	
	/** @test */
	
	function it_can_render_the_avatar_tag_with_classes() {
		
		
		$config = [];
		
		$converter = new HtmlToJsonConverter();
		
		$node = json_decode($converter->convertHtml('<avatar class="is-128x128"/>'), true);
		
		$htmlElement = new Avatar($node, $config, 0);
		
		$html = $htmlElement->getHtml();
		
		$this->assertStringContainsString('<img', $html);
		$this->assertStringContainsString('class="is-128x128"', $html);
		$this->assertStringContainsString('src="/images/avatars/profile.jpeg"', $html);
	}
	
	
	
	/** @test */
	
	function it_can_render_the_avatar_tag_with_styles() {
		$config = [];
		
		$converter = new HtmlToJsonConverter();
		
		$node = json_decode($converter->convertHtml('<avatar style="object-fit: cover;"/>'), true);
		
		$htmlElement = new Avatar($node, $config, 0);
		
		$html = $htmlElement->getHtml();
		
		$this->assertStringContainsString('<img', $html);
		$this->assertStringContainsString('style="object-fit: cover;"', $html);
		$this->assertStringContainsString('src="/images/avatars/profile.jpeg"', $html);
	}
}
