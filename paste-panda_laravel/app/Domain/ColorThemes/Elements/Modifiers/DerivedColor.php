<?php


namespace App\Domain\ColorThemes\Elements\Modifiers;


use App\ColorContrast\ColorItemV2;

class DerivedColor
{
	public static function make($hex){
		
		$derivedColor = ColorItemV2::make($hex);
		
		$derivedColor->alterBrightness(-20);
		
		return $derivedColor;
	}
}
