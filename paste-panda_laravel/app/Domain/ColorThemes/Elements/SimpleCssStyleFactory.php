<?php

namespace App\Domain\ColorThemes\Elements;

use App\Domain\Brand\CssStyleBuilder\AbstractCssStyle;
use App\Domain\Brand\CssStyleBuilder\CssStyle;
use App\Domain\ColorThemes\Elements\Utility\ICssStyleFactory;

abstract class SimpleCssStyleFactory implements ICssStyleFactory
{
    public static function make($selector, $value) : AbstractCssStyle
    {
        $item = new static();

        return CssStyle::make($selector)
            ->addStyle($item->property(), $value);
    }

    abstract public function property() : string;
}
