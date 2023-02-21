<?php

namespace App\Domain\Brand\CssStyleBuilder\States;

use App\Domain\Brand\CssStyleBuilder\AbstractCssStyle;

class BeforeCssStyle extends AbstractCssStyle
{
    public function __construct()
    {
        parent::__construct('', []);
    }

    public function getClassCssString($selector = ''): string
    {
        $newSelector = $selector . '::before';

        $str = '';

        if (count($this->getStyles()) > 0) {
            $str = $newSelector . ' {' . PHP_EOL;
            $str .= $this->getStyleString();
            $str .= '}' . PHP_EOL . PHP_EOL;
        }

        return $str;
    }
}
