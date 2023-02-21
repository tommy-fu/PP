<?php


namespace App\Domain\Brand\BrandBuilder;


use App\Domain\Brand\CssStylesCollection\Brand\BrandStyles\ContainerStyle;
use App\Domain\ColorThemes\Elements\Section;
use Illuminate\Support\Collection;

class BrandBaseCssStyles implements ICssStyleCollection
{
	
	/**
	 * BrandBaseCssStyles constructor.
	 */
	public function __construct()
	{
	}
	
	public function getCollection(): Collection
	{
		return collect([
			new ContainerStyle('container'),
			Section::makeCssStyle()
		]);
	}
}
