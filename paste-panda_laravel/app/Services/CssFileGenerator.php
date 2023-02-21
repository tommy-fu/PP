<?php

namespace App\Services;

use App\Domain\Brand\CssStylesCollection\CssStyleService;
use App\Domain\Brand\CssStylesCollection\PureCss;

class CssFileGenerator
{
    private CssStyleService $cssStyleService;
    private PureCss $pureCss;

    public function __construct()
    {
        $this->cssStyleService = app(CssStyleService::class);
        $this->pureCss = app(PureCss::class);
    }

    public function getCssFromBrand()
    {
        $cssString = $this->pureCss->getCss();

        $cssString .= $this->cssStyleService->getCss();

        return $cssString;
    }
}
