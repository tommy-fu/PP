<?php


namespace App\Domain\Brand\BrandBuilder\Creators;


use App\Domain\Brand\BrandBuilder\BrandBuilderConfig;
use App\Domain\Brand\CssStyleBuilder\Composites\WrapperCssStyle;

class AbstractBaseElementsCreator implements BaseCreatorInterface
{
	
	public static function make(BrandBuilderConfig $brandBuilderConfig)
	{
		$wrapperCss = new WrapperCssStyle();
		
		collect(static::$elements)
			->each(function ($element) use ($brandBuilderConfig, $wrapperCss) {
				(new $element)->handle($brandBuilderConfig)
					->each(function ($cssStyle) use ($wrapperCss) {
						$wrapperCss->addSubClass($cssStyle);
					});
			});
		
		return $wrapperCss;
	}
}
