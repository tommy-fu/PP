<?php

namespace App\Domain\Brand\CssStylesCollection\Brand;

use App\Domain\Brand\BrandBuilder\BrandBuilder;
use App\Domain\Brand\BrandBuilder\BrandDirector;
use App\Domain\Brand\CssStylesCollection\Base\CssStylesCollection;
use Illuminate\Support\Collection;

class BrandCssStyles extends CssStylesCollection
{
    public function getCssStyles(): Collection
    {
        $brandDirector = new BrandDirector();

        return $brandDirector->make(new BrandBuilder());
    }
}
