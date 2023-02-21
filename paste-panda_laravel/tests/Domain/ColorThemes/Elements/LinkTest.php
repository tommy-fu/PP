<?php

namespace Tests\Domain\ColorThemes\Elements;

use App\Domain\Brand\CssStyleBuilder\ResponsiveCssStyleDirector;
use App\Domain\Brand\CssStyleBuilder\States\ActiveCssStyle;
use App\Domain\Brand\CssStyleBuilder\States\DisabledCssStyle;
use App\Domain\Brand\CssStyleBuilder\States\HoverCssStyle;
use App\Domain\Brand\Models\Brand;
use App\Domain\ColorThemes\Colors;
use App\Domain\ColorThemes\Elements\Base\Link;
use Illuminate\Support\Str;
use Tests\DbTestCase;
use Tests\TestCase;

class LinkTest extends DbTestCase
{
    /** @test */
    public function it_can_get_correct_colors()
    {
        $link = new Link();

        $styles = $link->styles();

        $styles = collect($styles)
            ->map(function ($style) {
                return collect($style)
                    ->flatMap(function ($val, $key) {
                        return [$key => Str::random(6)];
                    });
            })->toArray();

        app()->singleton('brand', function () use ($styles) {
            return Factory(Brand::class)->create([
                'variables' => [
                    'link_md' => $styles,
                ],
            ]);
        });

        Colors::initialize([
            'link_md-color' => '#C8C8C8',
        ]);

        $responsive = new ResponsiveCssStyleDirector();

        $builder = Link::getMasterBuilder('link_md', 'link_md', 'link_md');

        $cssStyle = $responsive->make($builder);

        foreach ($styles['base_styles'] as $key => $value) {
            $this->assertEquals($value, $cssStyle->getStyleByKey($key));
        }

        $this->assertEquals('#C8C8C8', $cssStyle->getStyleByKey('color'));
    }

    /** @test */
    public function it_gets_primary_color_if_contrast_is_good_enough()
    {
        app()->singleton('brand', function () {
            return Factory(Brand::class)->create([
                'variables' => [
                    'link_md' => [
                        'base_styles' => [
                            'border-radius' => '50px',
                            'font-family' => 'Foobar',
                            'text-transform' => 'Uppercase',
                            'font-weight' => '400',
                            'border-width' => '1px',
                            'box-shadow' => '0 0 30px',
                            'cursor' => 'pointer',
                        ],
                        'mobile_styles' => [
                            'font-size' => '14px',
                        ],
                        'tablet_styles' => [
                            'font-size' => '24px',
                        ],
                        'desktop_styles' => [
                            'font-size' => '36px',
                        ],
                    ],
                ],
            ]);
        });

        Colors::initialize([
            'link_md-color' => '#C8C8C8',
            'background' => '#FFFFFF',
            'primary' => '#00C2FF',
        ]);

        $responsive = new ResponsiveCssStyleDirector();

        $builder = Link::getMasterBuilder('link_md', 'link_md', 'link_md');

        $cssStyle = $responsive->make($builder);

        $this->assertEquals('#00C2FF', $cssStyle->getStyleByKey('color'));
        $this->assertEquals('Foobar', $cssStyle->getStyleByKey('font-family'));
        $this->assertEquals('400', $cssStyle->getStyleByKey('font-weight'));
        $this->assertEquals('14px', $cssStyle->getStyleByKey('font-size'));
        $this->assertEquals('pointer', $cssStyle->getStyleByKey('cursor'));
	
	    Colors::initialize([
		    'link_md-color' => '#000000',
		    'background' => '#FFFFFF',
		    'primary' => '#CCCCFF',
	    ]);
	
	    $responsive = new ResponsiveCssStyleDirector();
	
	    $builder = Link::getMasterBuilder('link_md', 'link_md', 'link_md');
	
	    $cssStyle = $responsive->make($builder);
	
	    $this->assertEquals('#000000', $cssStyle->getStyleByKey('color'));
	    $this->assertEquals('Foobar', $cssStyle->getStyleByKey('font-family'));
	    $this->assertEquals('400', $cssStyle->getStyleByKey('font-weight'));
	    $this->assertEquals('14px', $cssStyle->getStyleByKey('font-size'));
	    $this->assertEquals('pointer', $cssStyle->getStyleByKey('cursor'));
    }

    /** @test */
    public function it_has_75_percent_opacity_on_hover()
    {
        $cssItem = new Link();

        $styles = $cssItem->styles();

        app()->singleton('brand', function () use ($styles) {
            return Factory(Brand::class)->create([
                'variables' => [
                    'link_md' => $styles,
                ],
            ]);
        });

        Colors::initialize();

        $builder = $cssItem::getMasterBuilder('link_md', 'link_md', 'link_md');

        $responsive = new ResponsiveCssStyleDirector();

        $cssStyle = $responsive->make($builder);

        $values = [
            HoverCssStyle::class => '0.35',
            ActiveCssStyle::class => '0.35',
            DisabledCssStyle::class => '0.25',
        ];

        foreach ($values as $classItem => $value) {
            $hoverStyle = collect($cssStyle->getAdditionalStyles())
                ->first(function ($style) use ($classItem) {
                    return $style->getSelector() == ':' . (new $classItem)->pseudo();
                });
            
            $this->assertEquals($value, $hoverStyle->getStyleByKey('opacity'));
        }
    }
}
