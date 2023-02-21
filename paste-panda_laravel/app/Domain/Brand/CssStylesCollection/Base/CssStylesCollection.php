<?php

namespace App\Domain\Brand\CssStylesCollection\Base;

use App\Domain\Brand\BrandBuilder\Viewports;
use Illuminate\Support\Collection;

abstract class CssStylesCollection
{
    abstract public function getCssStyles(): Collection;

    public function usesSuffix()
    {
        return false;
    }

    public function getCssStylesCollection(): Collection
    {
        $collection = $this->getCssStyles();

        if ($this->usesSuffix()) {
            foreach ($collection as $cssStyle) {
                $cssStyle->setUsesSuffix(true);
                foreach (Viewports::get() as $viewport) {
                    $cssStyle->addToViewports(new $viewport($cssStyle->getSelector() . '-' . $viewport::$suffix, $cssStyle->getStyles()));
                }
            }
        }

        return $collection;
    }
}
