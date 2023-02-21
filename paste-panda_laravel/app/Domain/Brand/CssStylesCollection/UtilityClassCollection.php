<?php

namespace App\Domain\Brand\CssStylesCollection;

use App\Domain\Brand\CssStylesCollection\Base\CssStylesCollection;
use App\Domain\Brand\CssStylesCollection\ResponsiveUtilityClasses\BorderHelpers;
use App\Domain\Brand\CssStylesCollection\ResponsiveUtilityClasses\ColumnClassHelpers;
use App\Domain\Brand\CssStylesCollection\ResponsiveUtilityClasses\FlexUtilityHelpers;
use App\Domain\Brand\CssStylesCollection\ResponsiveUtilityClasses\OpacityClasses;
use App\Domain\Brand\CssStylesCollection\ResponsiveUtilityClasses\RemixIconsCollection;
use App\Domain\Brand\CssStylesCollection\ResponsiveUtilityClasses\SocialMediaIconsCollection;
use App\Domain\Brand\CssStylesCollection\ResponsiveUtilityClasses\SpacingUtilityHelpers;
use App\Domain\Brand\CssStylesCollection\ResponsiveUtilityClasses\TypographyUtilityHelpers;
use App\Domain\Brand\CssStylesCollection\ResponsiveUtilityClasses\DisplayUtilityClasses;
use Illuminate\Support\Collection;

class UtilityClassCollection extends CssStylesCollection
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
            new FlexUtilityHelpers(),
            new DisplayUtilityClasses(),
            new TypographyUtilityHelpers(),
            new ColumnClassHelpers(),
            new SpacingUtilityHelpers(),
            new OpacityClasses(),
            new RemixIconsCollection(),
            new SocialMediaIconsCollection(),
        ]);
    }

    public function usesSuffix()
    {
        return true;
    }
}
