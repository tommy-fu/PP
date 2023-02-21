<?php

namespace App\Domain\Brand\BrandBuilder;

use App\Domain\Brand\BrandCssStylesCollection;
use App\Domain\ColorThemes\Colors;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class BrandBuilder implements IBrandBuilder
{
    public function __construct()
    {
        Colors::setScheme(Auth::user()->colorScheme);
    }

    public function getCollection() : Collection
    {
        return app(BrandCssStylesCollection::class)
            ->getCollection()
            ->flatMap(function ($collection) {
                return (new $collection)->getCollection();
            });
    }
}
