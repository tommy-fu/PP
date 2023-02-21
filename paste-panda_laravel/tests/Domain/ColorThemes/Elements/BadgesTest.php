<?php

namespace Tests\Domain\ColorThemes\Elements;

use App\Domain\Brand\CssStyleBuilder\ResponsiveCssStyleDirector;
use App\Domain\Brand\Models\Brand;
use App\Domain\ColorThemes\Colors;
use App\Domain\ColorThemes\Elements\Base\Badge;
use App\Domain\ColorThemes\Elements\Modifiers\BadgeModifiers;
use Tests\DbTestCase;

class BadgesTest extends DbTestCase
{
    /**
     * @test
     * @dataProvider modifiers()
     */
    public function it_can_set_correct_badge_modifier_colors($modifier)
    {
        Colors::initialize([
            $modifier => '#51A8FF',
        ]);

        $modifiers = BadgeModifiers::handle();

        $this->assertCount(4, $modifiers->getSubClasses());

        $modifier = $modifiers->getSubClasses()->first(function ($item) use ($modifier) {
            return $item->getSelector() == '.is-' . $modifier;
        });

        $this->assertNotNull($modifier);
        $this->assertEquals('rgba(49, 101, 153, 0.125) !important', $modifier->getStyleByKey('background'));
        $this->assertEquals('#316599 !important', $modifier->getStyleByKey('color'));
    }

    public function modifiers() : array
    {
        return [
            ['primary'],
            ['secondary'],
            ['tertiary'],
            ['quaternary'],
        ];
    }

    /** @test */
    public function it_has_base_styles()
    {
        Colors::initialize();

        $cssItem = new Badge();
        $styles = $cssItem->styles();

        app()->singleton('brand', function () use ($styles) {
            return Factory(Brand::class)->create([
                'variables' => [
                    'badge_md' => $styles,
                ],
            ]);
        });

        $responsive = new ResponsiveCssStyleDirector();

        $builder = $cssItem::getMasterBuilder('badge_md', 'badge_md', 'badge_md');

        $cssStyle = $responsive->make($builder);
        $this->assertNotNull($cssStyle);
        $this->assertEquals('inline-block', $cssStyle->getStyleByKey('display'));
    }
}
