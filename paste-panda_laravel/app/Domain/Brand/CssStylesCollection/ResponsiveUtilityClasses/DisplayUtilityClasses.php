<?php


namespace App\Domain\Brand\CssStylesCollection\ResponsiveUtilityClasses;


use App\Domain\ColorThemes\Elements\Utility\Display;

class DisplayUtilityClasses implements IUtilityClass
{
	
	public function getUtilityClasses()
	{
		return collect(['block', 'flex', 'inline', 'inline-block', 'inline-flex'])->map(function ($style) {
			return Display::make('is-' . $style, $style . ' !important');
		})
			->add(Display::make('is-hidden', 'none !important'));
	}
}
