<?php

namespace App\Domain\Brand\CssStylesCollection\Brand;


use Illuminate\Support\Collection;

class BrandFonts
{
    public function getCssStyles(): Collection
    {
        return new Collection();
    }

    public function getCssString(): string
    {
        return app('brand')->getFontFaceCss();
    }
}
