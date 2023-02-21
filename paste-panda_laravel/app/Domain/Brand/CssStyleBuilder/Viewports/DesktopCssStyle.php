<?php

namespace App\Domain\Brand\CssStyleBuilder\Viewports;

use App\Domain\Brand\CssStyleBuilder\CssStyle;

class DesktopCssStyle extends CssStyle
{
    public static $deviceWidth = 992;

    public static $suffix = 'desktop';
}
