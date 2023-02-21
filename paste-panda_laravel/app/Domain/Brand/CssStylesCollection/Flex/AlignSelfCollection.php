<?php


namespace App\Domain\Brand\CssStylesCollection\Flex;


use App\Domain\ColorThemes\Elements\Utility\Flex\AlignContent;
use App\Domain\ColorThemes\Elements\Utility\Flex\AlignItems;
use App\Domain\ColorThemes\Elements\Utility\Flex\AlignSelf;
use App\Domain\ColorThemes\Elements\Utility\Flex\FlexWrap;

class AlignSelfCollection extends AbstractUtilityCollection
{
	public static $prefix = 'is-align-self-';
	
	public static $items = ['auto', 'flex-start', 'flex-end', 'center', 'baseline', 'stretch'];
	
	public static $model = AlignSelf::class;
	
}
