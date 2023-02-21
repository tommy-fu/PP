<?php

namespace Tests\Domain\Brand\CssStyleBuilder\States;

use App\Domain\Brand\CssStyleBuilder\States\CardHoverable;
use App\Domain\ColorThemes\Colors;
use Tests\TestCase;

class HoverableCssStyleTest extends TestCase
{
    /** @test */
    public function it_has_a_name()
    {
        $hoverableCssStyle = new CardHoverable();

        $this->assertEquals('hover', $hoverableCssStyle->getName());
    }

    /** @test */
    public function it_has_a_pseudo_name()
    {
        $hoverableCssStyle = new CardHoverable();

        $this->assertEquals('hover', $hoverableCssStyle->pseudo());
    }

    /** @test */
    public function it_has_a_class_name()
    {
        $hoverableCssStyle = new CardHoverable();

        $this->assertEquals('is-hovered', $hoverableCssStyle->className());
    }

    /** @test */
    public function it_can_generate_a_hover_css_style()
    {
        Colors::initialize([
            'card_hover-background' => 'red',
        ]);

        $hoverableCssStyle = new CardHoverable();

        $cssStyle = $hoverableCssStyle->generate();

        $this->assertEquals('.is-hoverable', $cssStyle->getSelector());

        $hoverCssStyle = $hoverableCssStyle->cssStyle();

        $this->assertEquals(':hover', $hoverCssStyle->getSelector());
        $this->assertEquals('red', $hoverCssStyle->getStyleByKey('background'));

        $hoverCssStyle = collect($cssStyle->getAdditionalStyles())
            ->first(function ($subClass) {
                return $subClass->getSelector() == ':hover';
            });
        
        $this->assertEquals(':hover', $hoverCssStyle->getSelector());
        $this->assertEquals('red', $hoverCssStyle->getStyleByKey('background'));
    }
}
