<?php

namespace App\Domain\Brand\CssStyleBuilder\Composites;

use App\Models\HtmlModels\ICssStyle;

class ChildSelectorCssStyle extends AbstractCompositeCssStyle implements ICssStyle
{
    public static $sign = ' > ';
}
