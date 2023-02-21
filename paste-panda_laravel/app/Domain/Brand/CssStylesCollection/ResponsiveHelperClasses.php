<?php


namespace App\Domain\Brand\CssStylesCollection;


use App\Domain\Brand\CssStyleBuilder\CssStyle;
use App\Domain\Brand\CssStylesCollection\Base\CssStylesCollection;
use App\Domain\ColorThemes\Elements\Utility\Height;
use App\Domain\ColorThemes\Elements\Utility\MinHeight;
use App\Domain\ColorThemes\Elements\Utility\Overflow;
use App\Domain\ColorThemes\Elements\Utility\Position;
use App\Domain\ColorThemes\Elements\Utility\Width;
use Illuminate\Support\Collection;

class ResponsiveHelperClasses extends CssStylesCollection
{
	
	public function getCssStyles(): Collection
	{
		return collect([
			Width::make('has-width-auto', 'auto'),
			Width::make('is-fullwidth', '100%'),
			Height::make('is-fullheight', '100%'),
			Height::make('has-100vh', '100vh'),
			Height::make('has-height-25vh', '25vh'),
			Height::make('has-height-50vh', '50vh'),
			Height::make('has-height-75vh', '75vh'),
			Height::make('has-height-100vh', '100vh'),
			Height::make('has-height-auto', 'auto'),
			MinHeight::make('has-min-height-25vh', '25vh'),
			MinHeight::make('has-min-height-50vh', '50vh'),
			MinHeight::make('has-min-height-75vh', '75vh'),
			MinHeight::make('has-min-height-100vh', '100vh'),
			MinHeight::make('has-min-height-auto', 'auto'),
			Position::make('is-relative', 'relative'),
			Position::make('is-absolute', 'absolute'),
			Overflow::make('is-clipped', 'hidden'),
		]);
	}
	
	public function usesSuffix()
	{
		return true;
	}
}
