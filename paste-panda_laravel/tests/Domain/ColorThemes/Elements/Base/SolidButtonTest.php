<?php

namespace Tests\Domain\ColorThemes\Elements\Base;

use App\Domain\Brand\CssStyleBuilder\ResponsiveCssStyleDirector;
use App\Domain\Brand\Models\Brand;
use App\Domain\ColorThemes\Colors;
use App\Domain\ColorThemes\Elements\Base\SolidButton;
use Tests\DbTestCase;

class SolidButtonTest extends DbTestCase
{
    /** @test */
    public function it_has_75_percent_opacity_on_hover()
    {
        $cssItem = new SolidButton();

        $styles = $cssItem->styles();

        app()->singleton('brand', function () use ($styles) {
            return Factory(Brand::class)->create([
                'variables' => [
                    'button_md' => $styles,
                ],
            ]);
        });

        Colors::initialize();

        $builder = $cssItem::getMasterBuilder('button_md', 'button_md', 'button_md');

        $responsive = new ResponsiveCssStyleDirector();

        $cssStyle = $responsive->make($builder);

        $values = [
            ':hover' => '0.75',
            ':active' => '0.75',
            ':disabled' => '0.25',
        ];

        foreach ($values as $classItem => $value) {
            $hoverStyle = collect($cssStyle->getAdditionalStyles())
                ->first(function ($style) use ($classItem) {
                    return $style->getSelector() == $classItem;
                });

            $this->assertEquals($value, $hoverStyle->getStyleByKey('opacity'));
        }
    }
	
	/** @test */
	public function it_has_border_style_solid()
	{
		$cssItem = new SolidButton();
		
		$styles = $cssItem->styles();
		
		app()->singleton('brand', function () use ($styles) {
			return Factory(Brand::class)->create([
				'variables' => [
					'button_md' => $styles,
				],
			]);
		});
		
		Colors::initialize();
		
		$builder = $cssItem::getMasterBuilder('button_md', 'button_md', 'button_md');
		
		$responsive = new ResponsiveCssStyleDirector();
		
		$cssStyle = $responsive->make($builder);
		
		$this->assertEquals('solid', $cssStyle->getStyleByKey('border-style'));
	}
}
