<?php


namespace App\Domain\ColorThemes\Elements;


use Illuminate\Support\Collection;

class ColorModifiers
{
	private static $colors = ['primary', 'secondary', 'tertiary', 'quaternary'];
	
	public static function getColors() : Collection
	{
		return collect(self::$colors);
	}
}
