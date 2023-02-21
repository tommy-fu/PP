<?php

namespace Tests\Domain\ColorThemes\Elements;

use App\Domain\Brand\CssStyleBuilder\Composites\SameLevelCssStyle;
use App\Domain\Brand\CssStylesCollection\ResponsiveUtilityClasses\SocialMediaIconsCollection;
use App\Domain\Brand\Models\Brand;
use App\Domain\ColorThemes\Colors;
use App\Domain\ColorThemes\Elements\SocialMediaIcon;
use Illuminate\Support\Str;
use Tests\DbTestCase;

class SocialMediaIconContainerTest extends DbTestCase
{
    /** @test */
    public function it_can_get_correct_colors()
    {
        $cssItem = new SocialMediaIcon();

        $styles = collect($cssItem->styles())
            ->map(function ($style) {
                return collect($style)
                    ->flatMap(function ($val, $key) {
                        return [$key => Str::random(6)];
                    });
            })->toArray();

        app()->singleton('brand', function () use ($styles) {
            return Factory(Brand::class)->create([
                'variables' => [
                    'social_media_icon' => $styles,
                ],
            ]);
        });

        Colors::initialize([
            'social_media_icon-color' => '#C8C8C8',
            'social_media_icon-background' => 'transparent',
            'social_media_icon-border-color' => '#BABABA',
        ]);

        $cssStyle = (new SocialMediaIconsCollection)->getUtilityClasses()
            ->first();

        $this->assertEquals(SameLevelCssStyle::class, get_class($cssStyle->getSubClasses()->first()));

        $this->assertEquals('#C8C8C8', $cssStyle->getStyleByKey('color'));
        $this->assertEquals('transparent', $cssStyle->getStyleByKey('background'));
        $this->assertEquals('#BABABA', $cssStyle->getStyleByKey('border-color'));
        $this->assertEquals('pointer', $cssStyle->getStyleByKey('cursor'));
    }
}
