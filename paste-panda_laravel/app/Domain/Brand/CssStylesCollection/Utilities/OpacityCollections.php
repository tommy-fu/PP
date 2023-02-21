<?php


namespace App\Domain\Brand\CssStylesCollection\Utilities;


use App\Domain\Brand\CssStylesCollection\Flex\AbstractUtilityCollection;
use App\Domain\ColorThemes\Elements\Utility\Opacity;

class OpacityCollections extends AbstractUtilityCollection
{
	public static $prefix = 'has-opacity-';
	
	public static $items = ['0', '1'];
	
	public static $model = Opacity::class;
}
