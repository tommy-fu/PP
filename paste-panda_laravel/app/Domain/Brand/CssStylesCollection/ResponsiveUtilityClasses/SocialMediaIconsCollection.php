<?php

namespace App\Domain\Brand\CssStylesCollection\ResponsiveUtilityClasses;

use App\Domain\Brand\CssStyleBuilder\Composites\SameLevelCssStyle;
use App\Domain\Brand\CssStyleBuilder\CssStyle;
use App\Domain\Brand\CssStyleBuilder\ResponsiveCssStyleDirector;
use App\Domain\ColorThemes\Elements\SocialMediaIcon;

class SocialMediaIconsCollection implements IUtilityClass
{
    public function getUtilityClasses()
    {
        $sizes = [16, 24, 32, 40, 48, 56, 64, 72, 80, 88, 96];

        $director = new ResponsiveCssStyleDirector();
        $cssStyle = $director->make(SocialMediaIcon::getMasterBuilder('social-media-icon-container', 'social_media_icon', 'social_media_icon'));

        collect($sizes)
            ->each(function ($size) use ($cssStyle) {
                $sameLevel = new SameLevelCssStyle();

                $modifierCssStyle = CssStyle::make('is-' . $size . 'x' . $size);

                $modifierCssStyle->addStyle('width', $size . 'px !important');
                $modifierCssStyle->addStyle('min-width', $size . 'px !important');
                $modifierCssStyle->addStyle('height', $size . 'px !important');
                $modifierCssStyle->addStyle('min-height', $size . 'px !important');
                $modifierCssStyle->addStyle('font-size', $size . 'px !important');

                $sameLevel->addSubClass($modifierCssStyle);

                $cssStyle->addSubClass($sameLevel);
            });

        return collect([
            $cssStyle,
        ]);
    }
}
