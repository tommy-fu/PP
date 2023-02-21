<?php


namespace App\Domain\Brand\CssStylesCollection\Flex;


use App\Domain\ColorThemes\Elements\Utility\Flex\FlexDirection;

class FlexDirectionCollection extends AbstractUtilityCollection
{
	public static $prefix = 'is-flex-direction-';
	
	public static $items = ['row', 'row-reverse', 'column', 'column-reverse'];
	
	public static $model = FlexDirection::class;
	
}
