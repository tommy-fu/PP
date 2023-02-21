<?php

namespace App\Domain\Brand\BrandBuilder;

use App\Domain\Brand\CssStyleBuilder\Viewports\DesktopCssStyle;
use App\Domain\Brand\CssStyleBuilder\Viewports\LandscapeCssStyle;
use App\Domain\Brand\CssStyleBuilder\Viewports\TabletCssStyle;
use Illuminate\Support\Collection;

class Viewports
{
    public static function get(): Collection
    {
        return collect([
            LandscapeCssStyle::class,
            TabletCssStyle::class,
            DesktopCssStyle::class,
        ]);
    }
}
