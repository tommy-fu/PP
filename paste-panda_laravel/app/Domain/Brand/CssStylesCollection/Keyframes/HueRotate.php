<?php


namespace App\Domain\Brand\CssStylesCollection\Keyframes;


class HueRotate
{
	
	public static $className = 'hue-rotate-30';
	
	public static function make()
	{
		return '@keyframes ' . self::$className . '{ ' . PHP_EOL
			. '0% {
-webkit-filter: hue-rotate(0deg);
}
100% {
	-webkit-filter: hue-rotate(30deg);
}
}';
	
	}
	
	
}
