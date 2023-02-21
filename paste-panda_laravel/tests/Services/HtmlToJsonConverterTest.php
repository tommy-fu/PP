<?php

namespace Tests\Services;

use App\Services\HtmlToJsonConverter;
use PHPUnit\Framework\TestCase;

class HtmlToJsonConverterTest extends TestCase
{
    /** @test */
    public function it_can_render_img()
    {
        $html = '<div><img src="http://test.se"/></div>';

        $convert = new HtmlToJsonConverter();

        $res = json_decode($convert->convertHtml($html), true);

        $actual = [
            'element' => 'div',
            'attributes' => [],
            'children' => [
                [
                    'element' => 'img',
                    'attributes' => [
                        'src' => 'http://test.se',
                    ],
                ],
            ],
        ];

        $this->assertEquals($actual, $res);
    }


    /** @test */
    public function a_node_contains_the_same_values()
    {
        $html = '<div><img class="is-128x128" src="http://test.se" style="color: red;"></div>';

        $convert = new HtmlToJsonConverter();

        $res = json_decode($convert->convertHtml($html), true);

        $actual = [
            'element' => 'div',
            'attributes' => [],
            'children' => [
                [
                    'element' => 'img',
                    'attributes' => [
                        'src' => 'http://test.se',
                        'class' => 'is-128x128',
                        'style' => 'color: red;',
                    ],
                ],
            ],
        ];

        $this->assertEquals($actual, $res);
    }


    /** @test */
    public function it_can_have_tags_slider_slider()
    {
        $html = '<div><slider class="is-128x128" src="http://test.se" style="color: red;"/></div>';

        $convert = new HtmlToJsonConverter();

        $res = json_decode($convert->convertHtml($html), true);

        $actual = [
            'element' => 'div',
            'attributes' => [],
            'children' => [
                [
                    'element' => 'slider',
                    'attributes' => [
                        'src' => 'http://test.se',
                        'class' => 'is-128x128',
                        'style' => 'color: red;',
                    ],
                ],
            ],
        ];

        $this->assertEquals($actual, $res);
    }


    /** @test */
    public function it_will_not_include_comments()
    {
        $this->markTestSkipped();

        $html = '<!-- Comment one --><div><slider class="is-128x128" src="http://test.se" style="color: red;"/> <!-- This is a comment --></div>';

        $convert = new HtmlToJsonConverter();

        $html = $convert->convertHtml($html);

        $this->assertStringNotContainsString('#comment', $html);
    }

    /** @test */
    public function foo()
    {
        $html = '<div><img src="" alt=""></div>';
        
        $convert = new HtmlToJsonConverter();

        $convert->getDocument($html);
        
    }
}
