<?php


namespace App\Domain\Brand\CssStylesCollection\Utilities;


use App\Domain\Brand\CssStylesCollection\Flex\AbstractUtilityCollection;
use App\Domain\ColorThemes\Elements\Utility\Display;

class DisplayCollections extends AbstractUtilityCollection
{
	public static $prefix = 'is-';
	
	public static $items = ['block', 'flex', 'inline', 'inline-block', 'inline-flex'];
	
	public static $customItems = [
		'hidden' => 'none'
	];
	
	public static $model = Display::class;
}
