<?php

namespace Tests\Domain\ColorThemes\Elements;

use App\Domain\Brand\CssStyleBuilder\ResponsiveCssStyleDirector;
use App\Domain\Brand\CssStyleBuilder\States\PlaceholderCssStyle;
use App\Domain\Brand\Models\Brand;
use App\Domain\ColorThemes\Colors;
use App\Domain\ColorThemes\Elements\Base\Input;
use App\Domain\ColorThemes\Elements\Base\SolidButton;
use Tests\DbTestCase;

class InputTest extends DbTestCase
{
    /** @test */
    public function it_can_get_correct_styles()
    {
        app()->singleton('brand', function () {
            return Factory(Brand::class)->create([
                'variables' => [
                    'input_md' => [
                        'base_styles' => [
                            'font-weight' => '400',
                            'font-family' => 'Inter',
                            'text-decoration' => '',
                            'text-transform' => '',
                            'border-radius' => '50px',
                            'inset-box-shadow' => '',
                            'box-shadow' => '',
                            'border-width' => '',
                        ],
                        'mobile_styles' => [
                            'font-size' => '14px',
                            'padding' => '14px 40px',
                            'line-height' => '',
                            'letter-spacing' => '',
                        ],
                        'tablet_styles' => [
                            'font-size' => '18px',
                            'padding' => '14px 40px',
                            'line-height' => '',
                            'letter-spacing' => '',
                        ],
                        'desktop_styles' => [
                            'font-size' => '18px',
                            'padding' => '14px 40px',
                            'line-height' => '',
                            'letter-spacing' => '',
                        ],
                    ],
                ],
            ]);
        });

        Colors::initialize([
            'input_md-color' => '#C8C8C8',
            'input_md-background' => '#0F0F0F',
            'input_md-border-color' => '#CCCCCC',
//			'input_md-border-color' => '#C9C5C3',
//			'input_md-background' => '#5CE5CC',
        ]);

        $responsive = new ResponsiveCssStyleDirector();

        $builder = Input::getMasterBuilder('input_md', 'input_md', 'input_md');

        $cssStyle = $responsive->make($builder);

        $this->assertEquals('#C8C8C8', $cssStyle->getStyleByKey('color'));
        $this->assertEquals('#0F0F0F', $cssStyle->getStyleByKey('background'));
        $this->assertEquals('#CCCCCC', $cssStyle->getStyleByKey('border-color'));
        $this->assertEquals('Inter', $cssStyle->getStyleByKey('font-family'));
        $this->assertEquals('400', $cssStyle->getStyleByKey('font-weight'));
        $this->assertEquals('14px', $cssStyle->getStyleByKey('font-size'));
    }

    /** @test */
    public function it_has_placeholders()
    {
        app()->singleton('brand', function () {
            return Factory(Brand::class)->create([
                'variables' => [
                    'input_md' => [
                        'base_styles' => [
                            'font-weight' => '400',
                            'font-family' => 'Inter',
                            'text-decoration' => '',
                            'text-transform' => '',
                            'border-radius' => '50px',
                            'inset-box-shadow' => '',
                            'box-shadow' => '',
                            'border-width' => '',
                        ],
                        'mobile_styles' => [
                            'font-size' => '14px',
                            'padding' => '14px 40px',
                            'line-height' => '',
                            'letter-spacing' => '',
                        ],
                        'tablet_styles' => [
                            'font-size' => '18px',
                            'padding' => '14px 40px',
                            'line-height' => '',
                            'letter-spacing' => '',
                        ],
                        'desktop_styles' => [
                            'font-size' => '18px',
                            'padding' => '14px 40px',
                            'line-height' => '',
                            'letter-spacing' => '',
                        ],
                    ],
                ],
            ]);
        });

        Colors::initialize([
            'input_md-color' => '#C8C8C8',
            'input_md-background' => '#0F0F0F',
            'input_md-border-color' => '#CCCCCC',
            'input_md-placeholder' => '#CCCCCC',
//			'input_md-border-color' => '#C9C5C3',
//			'input_md-background' => '#5CE5CC',
        ]);

        $responsive = new ResponsiveCssStyleDirector();

        $builder = Input::getMasterBuilder('input_md', 'input_md', 'input_md');

        $cssStyle = $responsive->make($builder);

        $this->assertCount(4, $cssStyle->getAdditionalStyles());

        collect($cssStyle->getAdditionalStyles())
            ->each(function ($additionalCssStyle) {
                $this->assertNotNull(collect($additionalCssStyle->getSubClasses())->first(function ($style) {
                    return get_class($style) == PlaceholderCssStyle::class;
                }));
            });

        $placeholderCssStyle = collect($cssStyle->getSubClasses())->first(function ($style) {
            return get_class($style) == PlaceholderCssStyle::class;
        });

        $this->assertNotNull($placeholderCssStyle);

        $this->assertEquals('#CCCCCC', $placeholderCssStyle->getStyleByKey('color'));
    }
	
	
	
	/** @test */
	public function it_has_correct_base_styles()
	{
		$cssItem = new Input();
		
		$styles = $cssItem->styles();
		
		app()->singleton('brand', function () use ($styles) {
			return Factory(Brand::class)->create([
				'variables' => [
					'input_md' => $styles,
				],
			]);
		});
		
		Colors::initialize();
		
		$builder = $cssItem::getMasterBuilder('input_md', 'input_md', 'input_md');
		
		$responsive = new ResponsiveCssStyleDirector();
		
		$cssStyle = $responsive->make($builder);
		
		$this->assertEquals('solid', $cssStyle->getStyleByKey('border-style'));
		$this->assertEquals('none', $cssStyle->getStyleByKey('outline'));
		$this->assertEquals('100%', $cssStyle->getStyleByKey('width'));
	}
}
