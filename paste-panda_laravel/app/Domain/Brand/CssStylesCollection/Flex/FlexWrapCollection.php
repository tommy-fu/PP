<?php


namespace App\Domain\Brand\CssStylesCollection\Flex;


use App\Domain\ColorThemes\Elements\Utility\Flex\FlexWrap;

class FlexWrapCollection extends AbstractUtilityCollection
{
	public static $prefix = 'is-flex-wrap-';
	
	public static $items = ['nowrap', 'wrap', 'wrap-reverse'];
	
	public static $model = FlexWrap::class;
	
}
