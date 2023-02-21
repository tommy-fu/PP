<?php


namespace App\Domain\Brand\CssStylesCollection;

use Illuminate\Support\Collection;

class PureCss implements IRenderCss
{
    private Collection $cssStylesCollection;

    public function __construct(Collection $cssStylesCollection)
    {
        $this->cssStylesCollection = $cssStylesCollection;
    }

    public function getCss(): string
    {
        return $this->cssStylesCollection
            ->reduce(function ($carry, $collection) {
                return $carry . (new $collection)->getCssString();
            }, '');
    }
}
