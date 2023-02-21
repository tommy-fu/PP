<?php

namespace App\Domain\Brand\CssStylesCollection\ResponsiveUtilityClasses;

use App\Domain\Brand\CssStyleBuilder\Composites\SameLevelCssStyle;
use App\Domain\Brand\CssStyleBuilder\Composites\WrapperCssStyle;
use App\Domain\Brand\CssStyleBuilder\CssStyle;
use App\Domain\ColorThemes\Elements\Utility\Spacing\MarginLeft;
use App\Domain\ColorThemes\Elements\Utility\Width;

class ColumnClassHelpers implements IUtilityClass
{
	public function getUtilityClasses()
	{
		$cssStyles = [];
		
		for ($i = 1; $i < 13; $i++) {
			$cssStyles[] = Width::make("is-$i", 100 / 12 * $i . '%');
		}
		
		for ($i = 0; $i < 13; $i++) {
			$cssStyles[] = MarginLeft::make("is-offset-$i", 100 / 12 * $i . '%');
		}
		
		$cssStyle = new CssStyle('columns');
		$column = (new CssStyle('column'))
			->addStyle('display', 'flex')
			->addStyle('display', 'stretch');
		
		$cssStyle->addSubClass($column);
		
		
		$sameLevelCssStyle = new SameLevelCssStyle();
		$wrapper = new WrapperCssStyle();
//	    'columns.has-equal-column-height .column'
		
		$hasEqualColumnHeight = CssStyle::make('has-equal-column-height');
		
		$style = new CssStyle('column');
		$style->addStyle('display', 'flex');
		$style->addStyle('align-items', 'stretch');
		
		$wrapper->addSubClass($style);
		
		$hasEqualColumnHeight->addSubClass($wrapper);
		
		$sameLevelCssStyle->addSubClass($hasEqualColumnHeight);
		
		$cssStyle->addSubClass($sameLevelCssStyle);
		
		$cssStyles[] = $cssStyle;
		
//        $cssStyles[] = $wrapper;
//
//        $style = new CssStyleWrapper('columns.has-flexible-column-height .column');
//        $style->addStyle('display', 'block');
//        $style->addStyle('align-items', 'normal');
//
//        $cssStyles[] = $style;
		
		return $cssStyles;
	}
}
