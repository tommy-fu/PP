<?php


namespace App\Domain\Brand\CssStylesCollection\Flex;


use App\Domain\ColorThemes\Elements\Utility\Flex\AlignContent;
use App\Domain\ColorThemes\Elements\Utility\Flex\AlignItems;
use App\Domain\ColorThemes\Elements\Utility\Flex\FlexWrap;

class AlignItemsCollection extends AbstractUtilityCollection
{
	public static $prefix = 'is-align-items-';
	
	public static $items = ['stretch', 'flex-start', 'flex-end', 'center', 'baseline', 'start', 'end', 'self-start', 'self-end'];
	
	public static $model = AlignItems::class;
	
}
