<?php

namespace App\Domain\ColorThemes\Elements\Modifiers;

use App\ColorContrast\ColorItemV2;
use App\Domain\Brand\CssStyleBuilder\AbstractCssStyle;
use App\Domain\Brand\CssStyleBuilder\CssStyle;
use App\Domain\Brand\CssStylesCollection\Keyframes\HueRotate;

class TwoWayBackgroundGradient
{
    public static function make($selector, $gradient1) : AbstractCssStyle
    {
        $gradient2 = new ColorItemV2(str_replace('#', '', $gradient1));
        $gradient2->addHue(-30);

        $cssStyle = CssStyle::make($selector)
            ->addStyle('background', 'linear-gradient(225deg, ' . $gradient1 . ' 0%, ' . $gradient2 . ' 100%) !important');

        $cssStyle->addStyle('-webkit-background-clip', 'text');
        //		$cssStyle->addStyle('-webkit-box-decoration-break', 'clone');
        $cssStyle->addStyle('-webkit-text-fill-color', 'transparent');
//        $cssStyle->addStyle('-webkit-animation', HueRotate::$className . ' 2.75s infinite ease-in-out');
        $cssStyle->addStyle('animation-direction', 'normal');
        $cssStyle->addStyle('-webkit-animation-direction', 'alternate');

        return $cssStyle;
    }
}
