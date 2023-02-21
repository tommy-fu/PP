<?php


namespace App\Domain\Brand\BrandBuilder\Creators;

use App\Domain\Brand\BrandBuilder\Cards\CardStyle;
use App\Domain\Brand\BrandBuilder\Scheme\Overlay;

class BaseComponentsCreator extends AbstractBaseElementsCreator
{
    public static $elements = [
        Overlay::class,
        CardStyle::class,
    ];
}
