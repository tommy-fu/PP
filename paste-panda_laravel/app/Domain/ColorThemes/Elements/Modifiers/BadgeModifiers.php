<?php

namespace App\Domain\ColorThemes\Elements\Modifiers;

use App\ColorContrast\ColorItemV2;
use App\Domain\Brand\CssStyleBuilder\AbstractCssStyle;
use App\Domain\Brand\CssStyleBuilder\Composites\SameLevelCssStyle;
use App\Domain\Brand\CssStyleBuilder\CssStyle;
use App\Domain\ColorThemes\Colors;
use App\Domain\ColorThemes\Elements\ColorModifiers;

class BadgeModifiers
{
    public static function handle(): AbstractCssStyle
    {
        $sameLevelCssStyle = new SameLevelCssStyle();

        ColorModifiers::getColors()
            ->each(function ($modifier) use ($sameLevelCssStyle) {
                $color = ColorItemV2::make(Colors::make($modifier));

                $color->setBrightness(60);

                $badge = CssStyle::make('is-' . $modifier)
                    ->addStyle('background', $color->asRgba(0.125) . ' !important');

                $color->setBrightness(60);

                $badge->addStyle('color', $color->toFullHex() . ' !important');

                $sameLevelCssStyle->addSubClass($badge);
            });

        return $sameLevelCssStyle;
    }
}
