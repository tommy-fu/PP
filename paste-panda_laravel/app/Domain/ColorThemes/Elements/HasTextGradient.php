<?php

namespace App\Domain\ColorThemes\Elements;

use App\Domain\Brand\CssStyleBuilder\CssStyle;
use App\Domain\Brand\CssStyleBuilder\ElementCssStyle;
use App\Domain\Brand\CssStylesCollection\Keyframes\HueRotate;
use App\Domain\ColorThemes\Colors;

class HasTextGradient
{
    public static $baseStyles = [];

    public static function makeCssStyle($prefix = null)
    {
        $cssStyle = new CssStyle('has-text-gradient');
        
        $cssStyle->addStyle('-webkit-background-clip', 'text');
        $cssStyle->addStyle('-webkit-box-decoration-break', 'clone');
        $cssStyle->addStyle('-webkit-text-fill-color', 'transparent');
//        $cssStyle->addStyle('-webkit-animation', HueRotate::$className . ' 2.75s infinite ease-in-out');
        $cssStyle->addStyle('animation-direction', 'normal');
        $cssStyle->addStyle('-webkit-animation-direction', 'alternate');
        $cssStyle->addStyle('background-image', '-webkit-linear-gradient(232.25deg, #36FFEE 0%, #07B1BB 26.22%, #FC99EA 53.5%, #EDA2A4 77.58%, #D9E9FF 102.73%)');

        return $cssStyle;
    }
}
