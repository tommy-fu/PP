<?php


namespace App\Domain\Brand\CssStylesCollection\Flex;


use App\Domain\ColorThemes\Elements\Utility\Flex\AlignContent;
use App\Domain\ColorThemes\Elements\Utility\Flex\FlexGrow;
use App\Domain\ColorThemes\Elements\Utility\Flex\FlexWrap;

class FlexShrinkCollection extends AbstractUtilityCollection
{
	public static $prefix = 'flex-shrink-';
	
	public static $items = ['0', '1', '2', '3', '4', '5'];
	
	public static $model = FlexGrow::class;
	
}
