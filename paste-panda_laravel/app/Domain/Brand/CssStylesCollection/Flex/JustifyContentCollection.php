<?php


namespace App\Domain\Brand\CssStylesCollection\Flex;


use App\Domain\ColorThemes\Elements\Utility\Flex\JustifyContent;

class JustifyContentCollection extends AbstractUtilityCollection
{
	public static $prefix = 'is-justify-content-';
	
	public static $items = ['flex-start', 'flex-end', 'center', 'space-between', 'space-around', 'space-evenly', 'start', 'end', 'left', 'right'];
	
	public static $model = JustifyContent::class;
	
}
