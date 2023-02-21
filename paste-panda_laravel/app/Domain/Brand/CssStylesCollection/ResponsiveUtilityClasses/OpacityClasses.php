<?php

namespace App\Domain\Brand\CssStylesCollection\ResponsiveUtilityClasses;

use App\Domain\Brand\CssStyleBuilder\CssStyle;
use App\Domain\ColorThemes\Elements\Utility\Opacity;
use Illuminate\Support\Collection;

class OpacityClasses implements IUtilityClass
{
	public function getUtilityClasses()
	{
		return collect([
			Opacity::make('has-opacity-0', "0"),
			Opacity::make('has-opacity-1', "1")
		]);
	}
	
}
