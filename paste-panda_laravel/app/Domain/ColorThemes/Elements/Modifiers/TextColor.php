<?php

namespace App\Domain\ColorThemes\Elements\Modifiers;

use App\Domain\Brand\BrandBuilder\Viewports;
use App\Domain\Brand\CssStyleBuilder\AbstractCssStyle;
use App\Domain\Brand\CssStyleBuilder\CssStyle;
use App\Domain\ColorThemes\Elements\Utility\ICssStyleFactory;

class TextColor implements ICssStyleFactory
{
    public static function make($selector, $value) : AbstractCssStyle
    {
        return CssStyle::make($selector)
            ->addStyle('color', $value);
    }

    public static function makeWithSuffix($selector, $value) : AbstractCssStyle
    {
        $cssStyle = self::make($selector, $value)
            ->setUsesSuffix(true);

        foreach (Viewports::get() as $viewport) {
            $cssStyle->addToViewports(new $viewport($cssStyle->getSelector() . '-' . $viewport::$suffix, $cssStyle->getStyles()));
        }

        return $cssStyle;
    }
}
