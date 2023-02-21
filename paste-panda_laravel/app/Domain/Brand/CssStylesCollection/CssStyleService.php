<?php


namespace App\Domain\Brand\CssStylesCollection;

use App\Domain\Brand\CssStyleBuilder\CssStyleResult;
use Illuminate\Support\Collection;

class CssStyleService implements IRenderCss
{
    private Collection $cssStylesCollection;

    public function __construct(Collection $cssStylesCollection)
    {
        $this->cssStylesCollection = $cssStylesCollection;
    }

    public function getCss() : string
    {
        $cssStyleResult = new CssStyleResult();

        $this->cssStylesCollection
            ->flatMap(function ($collection) {
                return (new $collection)->getCssStylesCollection();
            })
            ->each(function ($cssStyle) use ($cssStyleResult) {
                $cssStyle->getClassCssString($cssStyleResult);
            });

        return $cssStyleResult->getCss();
    }
}
