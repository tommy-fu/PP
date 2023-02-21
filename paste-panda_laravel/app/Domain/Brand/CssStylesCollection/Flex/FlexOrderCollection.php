<?php


namespace App\Domain\Brand\CssStylesCollection\Flex;


use App\Domain\ColorThemes\Elements\Utility\Flex\Order;

class FlexOrderCollection extends AbstractUtilityCollection
{
	public static $prefix = 'order-';
	
	public static $items = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'];
	
	public static $model = Order::class;
	
}
