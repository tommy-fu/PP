<?php


namespace App\Domain\Brand\BrandBuilder\Creators;


use App\Domain\Brand\BrandBuilder\BrandBuilderConfig;
use App\Domain\Brand\BrandBuilder\Cards\CardStyle;
use App\Domain\Brand\BrandBuilder\Modifiers\BackgroundModifiers;
use App\Domain\Brand\BrandBuilder\Modifiers\BorderColorModifiers;
use App\Domain\Brand\BrandBuilder\Modifiers\ButtonModifiers;
use App\Domain\Brand\BrandBuilder\Modifiers\TextModifiers;
use App\Domain\Brand\BrandBuilder\Scheme\BaseElements;
use App\Domain\Brand\BrandBuilder\Scheme\Overlay;
use App\Domain\Brand\CssStyleBuilder\Composites\WrapperCssStyle;

class ModifiersCreator extends AbstractBaseElementsCreator
{
	
	static $elements = [
		TextModifiers::class,
		BackgroundModifiers::class,
		BorderColorModifiers::class,
		ButtonModifiers::class,
	];
	
}
