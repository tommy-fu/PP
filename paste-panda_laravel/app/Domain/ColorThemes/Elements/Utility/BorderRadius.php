<?php

namespace App\Domain\ColorThemes\Elements\Utility;

use App\Domain\Brand\BrandItem;
use App\Domain\Brand\CssStyleBuilder\AbstractCssStyle;
use App\Domain\Brand\CssStyleBuilder\CssStyle;
use App\Domain\Brand\CssStyleBuilder\Viewports\DesktopCssStyle;
use App\Domain\Brand\CssStyleBuilder\Viewports\TabletCssStyle;

class BorderRadius implements ICssStyleFactory
{
    public static function make($selector, $value): AbstractCssStyle
    {
        return CssStyle::make($selector)
            ->addStyle('border-radius', $value);
    }

    public static function makeResponsive($selector, BrandItem $brandItem): AbstractCssStyle
    {
        $cssStyle = CssStyle::make($selector)
            ->addStyle('border-radius', $brandItem->mobileStyles()->find('border-radius') . ' !important');

        $cssStyle->addToViewports(TabletCssStyle::make($selector)->addStyle('border-radius', $brandItem->getResponsiveStyle(TabletCssStyle::$suffix)->find('border-radius') . ' !important'));
        $cssStyle->addToViewports(DesktopCssStyle::make($selector)->addStyle('border-radius', $brandItem->getResponsiveStyle(DesktopCssStyle::$suffix)->find('border-radius') . ' !important'));

        return $cssStyle;
    }
}
