<?php

namespace Tests\Unit\Sections\Tags;

use App\Domain\Sections\HtmlTags\ImageTag;
use App\Domain\Sections\Models\HtmlConfig;
use App\Services\HtmlToJsonConverter;
use Tests\TestCase;

class ImageTagUnitTest extends TestCase
{
    /** @test */
    public function it_has_a_closing_bracket()
    {
        $config = new HtmlConfig();

        $html = '<img src="foobar">';

        $node = (new HtmlToJsonConverter)->convertHtml($html);

        $htmlElement = new ImageTag(json_decode($node, true), $config);

        $html = $htmlElement->getHtml();

        $this->assertStringContainsString('<img src="foobar"/>', $html);

        $this->assertStringContainsString('<img', $html);
        $this->assertStringContainsString('src="foobar"', $html);
        $this->assertStringContainsString('/>', $html);
    }
}
