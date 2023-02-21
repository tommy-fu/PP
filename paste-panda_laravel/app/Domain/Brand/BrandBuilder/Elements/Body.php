<?php

namespace App\Domain\Brand\BrandBuilder\Elements;

use App\Domain\Brand\BrandBuilder\BrandBuilderConfig;
use App\Domain\Brand\CssStyleBuilder\ElementCssStyle;
use App\Domain\ColorThemes\Colors;

class Body
{
    public function handle(BrandBuilderConfig $brandBuilderConfig)
    {
        return (new ElementCssStyle('body'))
            ->addStyle('background', Colors::make('background'));
    }
}
