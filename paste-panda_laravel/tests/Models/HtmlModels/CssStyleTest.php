<?php

namespace Tests\Models\HtmlModels;

use App\Domain\Brand\CssStyleBuilder\CssStyle;
use PHPUnit\Framework\TestCase;

class CssStyleTest extends TestCase
{
	/** @test */
    public function it_can_add_styles()
    {
        $cssStyle = new CssStyle('test');

        $cssStyle->addStyle('color', 'green');
        $cssStyle->addStyle('background', 'red');

        $res = [
            [
                'key' => 'color',
                'value' => 'green',
            ],
            [
                'key' => 'background',
                'value' => 'red',
            ],
        ];

        $this->assertEquals($res, $cssStyle->getStyles());
    }

    /** @test */
    public function it_can_have_a_classname()
    {
        $cssStyle = new CssStyle('test');

        $this->assertEquals('.test', $cssStyle->getSelector());
    }

    /** @test */
    public function adding_a_new_style_should_override_the_old_key_value_pair()
    {
        $cssStyle = new CssStyle('test');

        $cssStyle->addStyle('color', 'red');
        $cssStyle->addStyle('color', 'blue');

        $colors = collect($cssStyle->getStyles())
            ->filter(function ($style) {
                return $style['key'] == 'color';
            });

        $this->assertCount(1, $colors);
    }
	
	/** @test */
	
	function it_can_have_sub_classes() {
		$cssStyle = CssStyle::make('foo');
		
		$this->assertCount(0, $cssStyle->getSubClasses());
		
		$subClass = CssStyle::make('bar');
		
		$cssStyle->addSubClass($subClass);
		
		$this->assertCount(1, $cssStyle->getSubClasses());
    }
}
