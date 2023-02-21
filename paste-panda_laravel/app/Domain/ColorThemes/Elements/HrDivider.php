<?php

namespace App\Domain\ColorThemes\Elements;

use App\Domain\Brand\CssStyleBuilder\CssStyle;
use App\Domain\ColorThemes\Colors;

class HrDivider
{
    public static $baseStyles = [
        'border' => '0',
        'margin' => '0',
        'height' => '1px',
        'width' => '100%',
    ];

    public static function makeCssStyle($prefix = null)
    {
        $cssStyle = new CssStyle('hr');
        $cssStyle->setIsElement(true);

        foreach (self::$baseStyles as $key => $value) {
            $cssStyle->addStyle($key, $value);
        }

        $hrColorVariable = $prefix ? $prefix . '_' . 'divider' : 'divider';

        $cssStyle->addStyle('background', Colors::make($hrColorVariable));

        return $cssStyle;
    }
}
