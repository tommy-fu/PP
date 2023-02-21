<?php


namespace App\Domain\Brand\BrandBuilder\Creators;


use App\Domain\Brand\BrandBuilder\Modifiers\BaseTextModifiers;
use App\Domain\Brand\BrandBuilder\Scheme\BaseElements;

class BaseElementsCreator extends AbstractBaseElementsCreator
{
	static $elements = [
		BaseTextModifiers::class,
		BaseElements::class
	];
}
