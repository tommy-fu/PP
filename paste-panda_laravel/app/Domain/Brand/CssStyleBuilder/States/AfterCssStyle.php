<?php

namespace App\Domain\Brand\CssStyleBuilder\States;

use App\Domain\Brand\CssStyleBuilder\AbstractCssStyle;
use App\Domain\Brand\CssStyleBuilder\CssStyleResult;

class AfterCssStyle extends AbstractCssStyle
{
    public function __construct()
    {
        parent::__construct('', []);
    }

    public function getClassCssString(CssStyleResult $cssStyleResult, $selector = ''): void
    {
        $newSelector = $selector . '::after';

        $cssStyleResult->appendToCssByViewport($this->renderClass($newSelector));
    }
}
