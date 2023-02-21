<?php

namespace Tests\Models\HtmlElements\Base;

use App\Domain\Sections\HtmlTags\HtmlElement;
use App\Domain\Sections\Models\HtmlConfig;
use PHPUnit\Framework\TestCase;

class HtmlElementTest extends TestCase
{
    /** @test */
    public function it_renders_html_element()
    {
	    $this->markTestSkipped();
	    
        $node = [
            'element' => 'div',
            'attributes' => [
                'class' => 'test-class',
                'style' => 'color: black',
            ],
            'children' => [],
        ];

        $htmlConfig = new HtmlConfig();
        $htmlElement = new HtmlElement($node, $htmlConfig);

        $html = $htmlElement->getHtml();

        $this->assertStringContainsString('<div', $html);
        $this->assertStringContainsString('class="test-class"', $html);
        $this->assertStringContainsString('style="color: black"', $html);
        $this->assertStringContainsString('</div>', $html);
    }
}
