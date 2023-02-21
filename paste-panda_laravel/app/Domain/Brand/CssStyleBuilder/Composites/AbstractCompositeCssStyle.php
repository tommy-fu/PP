<?php

namespace App\Domain\Brand\CssStyleBuilder\Composites;

use App\Domain\Brand\CssStyleBuilder\AbstractCssStyle;
use App\Domain\Brand\CssStyleBuilder\CssStyleResult;
use App\Models\HtmlModels\ICssStyle;

abstract class AbstractCompositeCssStyle extends AbstractCssStyle implements ICssStyle
{
    public static $sign = null;

    public function __construct()
    {
        parent::__construct('', []);
    }

    public function getClassCssString(CssStyleResult $cssStyleResult, $selector = ''): void
    {
        $newSelector = $selector . static::$sign;

        $cssStyleResult->appendToCssByViewport($this->renderClass($newSelector));

        foreach ($this->getSubClasses() as $subClass) {
            $subClass->getClassCssString($cssStyleResult, $newSelector);
        }
    }
}
