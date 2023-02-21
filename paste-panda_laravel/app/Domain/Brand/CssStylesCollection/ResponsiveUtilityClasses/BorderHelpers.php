<?php

namespace App\Domain\Brand\CssStylesCollection\ResponsiveUtilityClasses;

use App\Domain\Brand\Models\Brand;
use App\Domain\ColorThemes\Elements\Utility\Border;
use App\Domain\ColorThemes\Elements\Utility\BorderRadius;

class BorderHelpers implements IUtilityClass
{
	public function getUtilityClasses()
	{
		return collect([
			BorderRadius::make('has-border-radius-none', 'none !important'),
			BorderRadius::makeResponsive('has-border-radius-xl', Brand::makeBrandItem('border_radius_xl')),
			BorderRadius::makeResponsive('has-border-radius-lg', Brand::makeBrandItem('border_radius_lg')),
			BorderRadius::makeResponsive('has-border-radius-md', Brand::makeBrandItem('border_radius_md')),
			BorderRadius::makeResponsive('has-border-radius-sm', Brand::makeBrandItem('border_radius_sm')),
			BorderRadius::makeResponsive('has-border-radius-xs', Brand::makeBrandItem('border_radius_xs')),
			BorderRadius::make('has-border-radius-rounded', '1000px !important'),
			Border::make('has-border-none', 'none !important')
		]);
	}
}
