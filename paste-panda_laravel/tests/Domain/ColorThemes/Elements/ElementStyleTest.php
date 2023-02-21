<?php

namespace Tests\Domain\ColorThemes\Elements;

use App\Domain\Brand\CssStyleBuilder\ResponsiveCssStyleDirector;
use App\Domain\Brand\Models\Brand;
use App\Domain\ColorThemes\Colors;
use App\Domain\ColorThemes\Elements\Base\Badge;
use App\Domain\ColorThemes\Elements\Base\FooterLink;
use App\Domain\ColorThemes\Elements\Base\Input;
use App\Domain\ColorThemes\Elements\Base\Link;
use App\Domain\ColorThemes\Elements\Base\NavButton;
use App\Domain\ColorThemes\Elements\Base\NavLink;
use App\Domain\ColorThemes\Elements\Base\SolidButton;
use App\Domain\ColorThemes\Elements\Base\TextBase;
use App\Domain\ColorThemes\Elements\Card;
use App\Domain\ColorThemes\Elements\SocialMediaIcon;
use Illuminate\Support\Str;
use Tests\DbTestCase;

class ElementStyleTest extends DbTestCase
{
	
	/**
     * @test
     * @dataProvider items()
     */
    public function it_can_get_correct_styles($classes, $item)
    {
        foreach ($classes as $class) {
            $cssItem = new $item();

            $styles = collect($cssItem->styles())
                ->map(function ($style) {
                    return collect($style)
                        ->flatMap(function ($val, $key) {
                            return [$key => Str::random(6)];
                        });
                })->toArray();

            app()->singleton('brand', function () use ($styles, $class) {
                return Factory(Brand::class)->create([
                    'variables' => [
                        $class => $styles,
                    ],
                ]);
            });

            $colorKeys = collect($cssItem->attributes())
                ->flatMap(function ($key, $val) use ($class) {
                    return [$key => '#' . Str::random(6)];
                })->toArray();

            $colors = collect($colorKeys)
                ->flatMap(function ($key, $val) use ($class) {
                    return [$class . '-' . $val => $key];
                })->toArray();

            Colors::initialize($colors);

            $responsive = new ResponsiveCssStyleDirector();

            $builder = $cssItem::getMasterBuilder($class, $class, $class);

            $cssStyle = $responsive->make($builder);

            foreach ($styles['base_styles'] as $key => $value) {
                $this->assertEquals($value, $cssStyle->getStyleByKey($key));
            }
        }
    }

    public function items(): array
    {
        return [
            [['link_md'], Link::class],
            [['button_md'], SolidButton::class],
            [['nav_button'], NavButton::class],
            [['h1'], TextBase::class],
            [['nav_link'], NavLink::class],
            [['footer_link'], FooterLink::class],
            [['input_md'], Input::class],
            [['badge_md'], Badge::class],
            [['card'], Card::class],
            [['social_media_icon'], SocialMediaIcon::class],
        ];
    }
}
