<?php


namespace App\Domain\Brand\CssStylesCollection\ResponsiveUtilityClasses;


use App\Domain\Brand\CssStyleBuilder\CssStyle;
use App\Domain\ColorThemes\Elements\Texts\FontWeight;
use App\Domain\ColorThemes\Elements\Utility\Typography\TextAlign;
use App\Domain\ColorThemes\Elements\Utility\Typography\TextTransform;

class TypographyUtilityHelpers implements IUtilityClass
{
	
	public function getUtilityClasses()
	{
		return collect([
			TextAlign::make('has-text-centered', 'center'),
			TextAlign::make('has-text-left', 'left'),
			TextAlign::make('has-text-right', 'right'),
			
			
			TextTransform::make('is-capitalized', 'capitalized'),
			TextTransform::make('is-lowercase', 'lowercase'),
			TextTransform::make('is-uppercase', 'uppercase'),
			TextTransform::make('is-italic', 'italic'),
			
			
			FontWeight::make('has-font-weight-semibold', '600'),
			FontWeight::make('has-font-weight-bold', '700'),
		]);
	}
}
