<?php

namespace App\Domain\Brand\BrandBuilder\Modifiers;

use App\Domain\Brand\BrandBuilder\BrandBuilderConfig;
use App\Domain\Brand\CssStyleBuilder\Composites\AbstractCompositeCssStyle;
use App\Domain\Brand\CssStyleBuilder\Composites\SameLevelCssStyle;
use App\Domain\Brand\CssStyleBuilder\CssStyle;
use App\Domain\ColorThemes\Colors;
use App\Domain\ColorThemes\Elements\Modifiers\BorderColor;
use App\Domain\ColorThemes\Elements\Modifiers\TextColor;
use App\Domain\ColorThemes\Elements\Modifiers\TwoWayBackgroundGradient;
use App\Domain\ColorThemes\Elements\Modifiers\TwoWayTextGradient;
use App\Domain\ColorThemes\Elements\Base\SolidButton;


class ButtonModifiers
{
	private $modifiers = [
		'primary' => 'primary',
		'secondary' => 'secondary',
		'tertiary' => 'tertiary',
		'quaternary' => 'quaternary',
	];
	
	public function handle(BrandBuilderConfig $brandBuilderConfig)
	{
		$cssItem = new SolidButton();
		return
			collect($cssItem->items())
				->flatMap(function ($button) {
					return collect($this->modifiers)
						->flatMap(function ($modifier, $key) use ($button) {
							
							$cssStyle = CssStyle::make($button['key']);
							
							$sameLvlCssStyle = new SameLevelCssStyle();
							
							$gradientColor = TwoWayTextGradient::make('is-foo' . $modifier, 'FCFCFC');
							
							$sameLvlCssStyle->addSubClass($gradientColor);
							
							$cssStyle->addSubClass($sameLvlCssStyle);
							
							return $cssStyle;
						});
				})->flatten();
	}
}
