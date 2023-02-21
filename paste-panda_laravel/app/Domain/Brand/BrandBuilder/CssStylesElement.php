<?php


namespace App\Domain\Brand\BrandBuilder;

use App\Domain\Brand\BrandBuilder\Creators\BaseComponentsCreator;
use App\Domain\Brand\BrandBuilder\Creators\BaseElementsCreator;
use App\Domain\Brand\BrandBuilder\Creators\ModifiersCreator;
use App\Domain\Brand\CssStyleBuilder\CssStyle;
use App\Domain\Brand\CssStyleBuilder\ResponsiveCssStyleDirector;
use App\Domain\ColorThemes\Colors;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class CssStylesElement implements ICssStyleCollection
{
    public function getCollection(): Collection
    {
        $brandBuilderConfig = (new BrandBuilderConfig())
            ->setDirector(new ResponsiveCssStyleDirector())
            ->setScheme(Auth::user()->colorScheme);

        $schemeCssStyle = (new CssStyle('scheme-' . ($brandBuilderConfig->getScheme()->id)))
            ->addStyle('background', Colors::make('background'));

        $schemeCssStyle->addSubClass(BaseComponentsCreator::make($brandBuilderConfig))
            ->addSubClass(BaseElementsCreator::make($brandBuilderConfig))
            ->addSubClass(ModifiersCreator::make($brandBuilderConfig));

        return collect([$schemeCssStyle]);
    }
}
