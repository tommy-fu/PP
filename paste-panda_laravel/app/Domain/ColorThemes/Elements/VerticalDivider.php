<?php

namespace App\Domain\ColorThemes\Elements;

use App\Domain\Brand\CssStyleBuilder\CssStyle;
use App\Domain\Brand\CssStyleBuilder\ElementCssStyle;
use App\Domain\ColorThemes\Colors;

class VerticalDivider
{
    public static $baseStyles = [
        'border' => '0',
        'margin' => '0',
        'height' => '100%',
        'width' => '1px',
    ];

    public static function makeCssStyle($prefix = null)
    {
        $cssStyle = new CssStyle('vertical-divider');
//        $cssStyle->setIsElement(true);

        foreach (self::$baseStyles as $key => $value) {
            $cssStyle->addStyle($key, $value);
        }

        $hrColorVariable = $prefix ? $prefix . '_' . 'divider' : 'divider';

        $cssStyle->addStyle('background', Colors::make($hrColorVariable));

        return $cssStyle;
    }
}
