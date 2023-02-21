<?php


namespace App\Domain\Brand\CssStylesCollection\ResponsiveUtilityClasses;


use App\Domain\Brand\CssStylesCollection\Flex\AlignContentCollection;
use App\Domain\Brand\CssStylesCollection\Flex\AlignItemsCollection;
use App\Domain\Brand\CssStylesCollection\Flex\AlignSelfCollection;
use App\Domain\Brand\CssStylesCollection\Flex\FlexDirectionCollection;
use App\Domain\Brand\CssStylesCollection\Flex\FlexGrowCollection;
use App\Domain\Brand\CssStylesCollection\Flex\FlexOrderCollection;
use App\Domain\Brand\CssStylesCollection\Flex\FlexShrinkCollection;
use App\Domain\Brand\CssStylesCollection\Flex\FlexWrapCollection;
use App\Domain\Brand\CssStylesCollection\Flex\JustifyContentCollection;

class FlexUtilityHelpers implements IUtilityClass
{
	
	private $collections = [
		FlexDirectionCollection::class,
		FlexWrapCollection::class,
		JustifyContentCollection::class,
		AlignContentCollection::class,
		AlignItemsCollection::class,
		AlignSelfCollection::class,
		FlexGrowCollection::class,
		FlexShrinkCollection::class,
		FlexOrderCollection::class
	];
	
	public function getUtilityClasses()
	{
		return collect($this->collections)
			->map(function ($collection) {
				return $collection::getCollection();
			})->flatten();
	}
	
}
