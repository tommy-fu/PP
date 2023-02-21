<?php


namespace App\SchemeBuilder;


use App\ColorContrast\Color;
use App\ColorContrast\ColorItemV2;

class AnalogousColors
{
	
	public static function make($hex): array
	{
		return [
			'primary' => ColorItemV2::make($hex)->toFullHex(),
			'secondary' => ColorItemV2::make($hex)->addHue(-40)->toFullHex(),
			'tertiary' => ColorItemV2::make($hex)->addHue(-80)->toFullHex(),
			'quaternary' => ColorItemV2::make($hex)->addHue(-120)->toFullHex(),
		];
	}
}
