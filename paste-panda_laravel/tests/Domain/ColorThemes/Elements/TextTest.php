<?php

namespace Tests\Domain\ColorThemes\Elements;

use App\Domain\Brand\CssStyleBuilder\Composites\ChildSelectorCssStyle;
use App\Domain\Brand\CssStyleBuilder\ResponsiveCssStyleDirector;
use App\Domain\Brand\Models\Brand;
use App\Domain\ColorThemes\Colors;
use App\Domain\ColorThemes\Elements\Base\BodyText;
use App\Domain\ColorThemes\Elements\Base\TextBase;
use Tests\DbTestCase;

class TextTest extends DbTestCase
{
    /** @test */
    public function it_can_get_correct_styles()
    {
        app()->singleton('brand', function () {
            return Factory(Brand::class)->create([
                'variables' => [
                    'body_md' => [
                        'base_styles' => [
                            'font-weight' => '400',
                            'font-family' => 'Inter',
                            'text-decoration' => '',
                            'text-transform' => '',
                            'foobar' => '',
                        ],
                        'mobile_styles' => [
                            'font-size' => '14px',
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
            'body_md' => '#C8C8C8',
        ]);

        $responsive = new ResponsiveCssStyleDirector();

        $builder = TextBase::getMasterBuilder('body_md', 'body_md', 'body_md');

        $cssStyle = $responsive->make($builder);

        $this->assertEquals('#C8C8C8', $cssStyle->getStyleByKey('color'));
    }


    /** @test */
    public function it_has_inline_links()
    {
        app()->singleton('brand', function () {
            return Factory(Brand::class)->create([
                'variables' => [
                    'body_md' => [
                        'base_styles' => [
                            'font-weight' => '400',
                            'font-family' => 'Inter',
                            'text-decoration' => '',
                            'text-transform' => '',
                            'foobar' => '',
                        ],
                        'mobile_styles' => [
                            'font-size' => '14px',
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
                    'body_md_inline_link' => [
                        'base_styles' => [
                            'font-weight' => '400',
                            'font-family' => 'Inter',
                            'text-decoration' => 'none',
                            'text-transform' => '',
                        ],
                        'mobile_styles' => [
                            'font-size' => '14px',
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
            'body_md' => '#C8C8C8',
            'body_md_inline_link-color' => 'red',
        ]);

        $responsive = new ResponsiveCssStyleDirector();

        $builder = BodyText::getMasterBuilder('body_md', 'body_md', 'body_md');

        $cssStyle = $responsive->make($builder);

        $childCssStyle = $cssStyle->getSubClasses()
            ->first(function ($subClass) {
                return get_class($subClass) == ChildSelectorCssStyle::class;
            });

        $this->assertNotNull($childCssStyle);

        $anchorTag = $childCssStyle->getSubClasses()->first(function ($subClass) {
            return $subClass->getSelector() == 'a';
        });

        $this->assertNotNull($anchorTag);
        $this->assertEquals('a', $anchorTag->getSelector());

        $this->assertEquals('red', $anchorTag->getStyleValueByKey('color'));
        $this->assertEquals('none', $anchorTag->getStyleValueByKey('text-decoration'));
        $this->assertNull($anchorTag->getStyleValueByKey('font-size'));
    }
}
