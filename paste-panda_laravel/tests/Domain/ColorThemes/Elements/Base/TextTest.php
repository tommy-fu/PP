<?php

namespace Tests\Domain\ColorThemes\Elements\Base;

use App\Domain\Brand\CssStyleBuilder\ResponsiveCssStyleDirector;
use App\Domain\Brand\Models\Brand;
use App\Domain\ColorThemes\Colors;
use App\Domain\ColorThemes\Elements\Base\TextBase;
use Tests\DbTestCase;

class TextTest extends DbTestCase
{
    /** @test */
    public function it_can_get_correct_colors()
    {
        app()->singleton('brand', function () {
            return Factory(Brand::class)->create([
                'variables' => [
                    'h1' => [
                        'base_styles' => [
                            'font-weight' => '500',
                            'font-family' => 'Interaa',
                            'text-decoration' => '',
                            'text-transform' => '',
                        ],
                        'mobile_styles' => [
                            'font-size' => '18px',
                            'line-height' => '24px',
                            'letter-spacing' => '-3.5%',
                        ],
                        'tablet_styles' => [
                            'font-size' => '14px',
                            'line-height' => '24px',
                            'letter-spacing' => '-3.5%',
                        ],
                        'desktop_styles' => [
                            'font-size' => '18px',
                            'line-height' => '24px',
                            'letter-spacing' => '-3.5%',
                        ],
                    ],
                ],
            ]);
        });

        Colors::initialize([
            'h1' => '#8B8B8B',
        ]);
        
        $responsive = new ResponsiveCssStyleDirector();

        $builder = TextBase::getMasterBuilder('h1', 'h1', 'h1');

        $cssStyle = $responsive->make($builder);
        
        $this->assertEquals('#8B8B8B', $cssStyle->getStyleByKey('color'));
        $this->assertEquals('Interaa', $cssStyle->getStyleByKey('font-family'));
        $this->assertEquals('500', $cssStyle->getStyleByKey('font-weight'));
        $this->assertEquals('18px', $cssStyle->getStyleByKey('font-size'));
    }
}
