<?php

namespace App\Domain\ColorThemes\Elements;

use App\Domain\Brand\CssStyleBuilder\AbstractCssStyle;
use App\Domain\Brand\CssStyleBuilder\Composites\SameLevelCssStyle;
use App\Domain\Brand\CssStyleBuilder\CssStyle;
use App\Domain\ColorSchemeBuilder\ContrastChecker;
use App\Domain\ColorThemes\Colors;

class SolidButtonColorModifiers implements ModifierInterface
{
    public static function handle($colorVariable = null): AbstractCssStyle
    {
        $sameLevelCssStyle = new SameLevelCssStyle();

        ColorModifiers::getColors()
            ->each(function ($modifier) use ($sameLevelCssStyle) {
                $modifierCssStyle = CssStyle::make('is-' . $modifier)
                    ->addStyle('background', Colors::make($modifier) . ' !important')
                    ->addStyle('border-color', Colors::make($modifier) . ' !important')
                    ->addStyle('color', ContrastChecker::getBestContrast(Colors::make($modifier), Colors::make('h1'), 'ffffff') . ' !important');

                $sameLevelCssStyle->addSubClass($modifierCssStyle);
            });

        return $sameLevelCssStyle;
    }
}
