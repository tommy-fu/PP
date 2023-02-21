<?php

namespace App\Domain\ColorThemes\Elements;

use App\Domain\Brand\CssStyleBuilder\CssStyle;

class LogoFill
{
    public static function makeCssStyle($prefix = null)
    {
        $cssStyle = new CssStyle('logo-fill path');

        $cssStyle->addStyle('fill', app('colors')['text']);

        return $cssStyle;
    }
}
