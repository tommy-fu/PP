<?php

namespace App\Domain\Brand\CssStylesCollection;

use App\Domain\Brand\CssStylesCollection\Base\CssStylesCollection;
use App\Domain\Brand\CssStylesCollection\ResponsiveUtilityClasses\BorderHelpers;
use App\Domain\ColorThemes\Elements\Utility\Border;
use Illuminate\Support\Collection;


class ResponsiveUtilityClassCollection extends CssStylesCollection
{
    public function getCssStyles(): Collection
    {
        return $this->getHelpersCollection()
            ->flatMap(function ($helper) {
                return $helper->getUtilityClasses();
            });
    }

    /**
     * @return Collection
     */
    public function getHelpersCollection(): Collection
    {
        return collect([
            new BorderHelpers(),
        ]);
    }
}
