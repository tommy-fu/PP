<?php

namespace App\Domain\ColorThemes\Elements;

use App\Domain\Brand\CssStyleBuilder\CssStyle;

class CursorSelection
{
    public static function makeCssStyle($prefix = null)
    {
        $cssStyle = new CssStyle('::selection');
//        $cssStyle->setUsesClassName(false);
        $cssStyle->setUsesSpace(false);
        $cursorSelectionVariable = $prefix ? $prefix . '_' . 'cursor_selection' : 'cursor_selection';

        $cssStyle->addStyle('color', app('colors')[$cursorSelectionVariable . '-text']);
        $cssStyle->addStyle('background', app('colors')[$cursorSelectionVariable . '-background']);

        return $cssStyle;
    }
}
