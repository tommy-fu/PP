<?php

namespace App\Domain\Brand\BrandBuilder\Modifiers;

use App\Domain\Brand\BrandBuilder\BrandBuilderConfig;
use App\Domain\Brand\CssStyleBuilder\Composites\SameLevelCssStyle;
use App\Domain\ColorThemes\Colors;
use App\Domain\ColorThemes\Elements\Modifiers\BorderColor;
use App\Domain\ColorThemes\Elements\Modifiers\TextColor;
use App\Domain\ColorThemes\Elements\Modifiers\TwoWayBackgroundGradient;
use App\Domain\ColorThemes\Elements\Modifiers\TwoWayTextGradient;


class BorderColorModifiers
{
	private $modifiers = [
		'primary' => 'primary',
		'secondary' => 'secondary',
		'tertiary' => 'tertiary',
		'quaternary' => 'quaternary',
	];
	
	public function handle(BrandBuilderConfig $brandBuilderConfig)
	{
		return collect($this->modifiers)
			->map(function ($modifier, $key) {
				
				$cssStyle = BorderColor::make('has-border-' . $key, Colors::make($modifier) . ' !important');
				
				$gradientColor = Colors::make($key);
				
				if ($gradientColor) {
					
					$sameLvlCssStyle = new SameLevelCssStyle();
					
					$gradientColor = TwoWayTextGradient::make('has-border-gradient', $gradientColor);
					
					$sameLvlCssStyle->addSubClass($gradientColor);
					
					$cssStyle->addSubClass($sameLvlCssStyle);
					
				}
				
				return $cssStyle;
			});
		
	}
}
