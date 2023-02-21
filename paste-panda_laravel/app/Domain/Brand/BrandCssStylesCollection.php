<?php


namespace App\Domain\Brand;


use Illuminate\Support\Collection;

class BrandCssStylesCollection
{
    private Collection $collection;

    public function __construct(Collection $collection)
    {
        $this->collection = $collection;
    }

    public function getCollection() : Collection
    {
        return $this->collection;
    }
}
