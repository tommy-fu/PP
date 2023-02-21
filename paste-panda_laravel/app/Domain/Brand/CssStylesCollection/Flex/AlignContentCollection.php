<?php


namespace App\Domain\Brand\CssStylesCollection\Flex;


use App\Domain\ColorThemes\Elements\Utility\Flex\AlignContent;
use App\Domain\ColorThemes\Elements\Utility\Flex\FlexWrap;

class AlignContentCollection extends AbstractUtilityCollection
{
	public static $prefix = 'is-align-content-';
	
	public static $items = ['flex-start', 'flex-end', 'center', 'space-between', 'space-around', 'space-evenly', 'stretch', 'start', 'end', 'baseline'];
	
	public static $model = AlignContent::class;
	
}
