<?php


namespace App\Domain\Brand\BrandBuilder\Creators;

use App\Domain\Brand\BrandBuilder\Modifiers\BackgroundModifiers;
use App\Domain\Brand\BrandBuilder\Modifiers\BorderColorModifiers;
use App\Domain\Brand\BrandBuilder\Modifiers\ButtonModifiers;
use App\Domain\Brand\BrandBuilder\Modifiers\TextModifiers;

class SchemeModifiersCreator extends AbstractBaseElementsCreator
{
    public static $elements = [
        TextModifiers::class,
        BackgroundModifiers::class,
        BorderColorModifiers::class,
        ButtonModifiers::class,
    ];
}
