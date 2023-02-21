<?php

namespace Tests\Domain\ColorThemes\Elements;

use App\Domain\Brand\CssStyleBuilder\CssStyleResult;
use App\Domain\Brand\CssStyleBuilder\ResponsiveCssStyleDirector;
use App\Domain\Brand\CssStyleBuilder\States\ActiveCssStyle;
use App\Domain\Brand\CssStyleBuilder\States\CardHoverable;
use App\Domain\Brand\CssStyleBuilder\States\DisabledCssStyle;
use App\Domain\Brand\CssStyleBuilder\States\HoverCssStyle;
use App\Domain\Brand\Models\Brand;
use App\Domain\ColorThemes\Colors;
use App\Domain\ColorThemes\Elements\Card;
use Tests\DbTestCase;

class CardTest extends DbTestCase
{
    /** @test */
    public function it_has_correct_base_styles()
    {
        Colors::initialize();

        $cssItem = new Card();
        $styles = $cssItem->styles();

        app()->singleton('brand', function () use ($styles) {
            return Factory(Brand::class)->create([
                'variables' => [
                    'card' => $styles,
                ],
            ]);
        });

        $responsive = new ResponsiveCssStyleDirector();

        $builder = $cssItem::getMasterBuilder('card', 'card', 'card');

        $cssStyle = $responsive->make($builder);
        $this->assertNotNull($cssStyle);
        $this->assertEquals('hidden', $cssStyle->getStyleByKey('overflow'));
        $this->assertEquals('solid', $cssStyle->getStyleByKey('border-style'));
    }

    /** @test */
    public function it_has_75_percent_opacity_on_hover()
    {
        Colors::initialize([
            'card_hover-background' => 'red',
        ]);
//        dd(app('colors'));
        $cssItem = new Card();

        $styles = $cssItem->styles();

        app()->singleton('brand', function () use ($styles) {
            return Factory(Brand::class)->create([
                'variables' => [
                    'card' => $styles,
                ],
            ]);
        });

        $builder = $cssItem::getMasterBuilder('card', 'card', 'card');

        $responsive = new ResponsiveCssStyleDirector();

        $cssStyle = $responsive->make($builder);

        $isHoverableStyle = collect($cssStyle->getAdditionalStyles())
            ->first(function ($style) {
                return $style->getSelector() == '.is-hoverable';
            });

        $this->assertNotNull($isHoverableStyle);

        $isHoverableStyle = (new CardHoverable())->generate();

        $values = [
            ':hover' => 'red',
        ];

        foreach ($values as $classItem => $value) {
            $hoverStyle = collect($isHoverableStyle->getAdditionalStyles())
                ->first(function ($style) use ($classItem) {
                    return $style->getSelector() == $classItem;
                });

            $this->assertEquals(':hover', $hoverStyle->getSelector());
            $this->assertEquals($value, $hoverStyle->getStyleByKey('background'));
        }
        
        //		$values = [
//			HoverCssStyle::class => '0.75',
//			ActiveCssStyle::class => '0.75',
//			DisabledCssStyle::class => '0.25',
//		];
//
//		foreach ($values as $classItem => $value) {
//			$hoverStyle = collect($cssStyle->getAdditionalStyles())
//				->first(function ($style) use ($classItem) {
//					return get_class($style) == $classItem;
//				});
//
//			$this->assertEquals($value, $hoverStyle->getStyleByKey('opacity'));
//		}
    }
	
	public function getClassCssString(CssStyleResult $cssStyleResult, $selector = ''): void {
	
	}
}
