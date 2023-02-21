<?php

namespace App\Domain\Brand\CssStylesCollection\ResponsiveUtilityClasses;

use App\Domain\Brand\CssStyleBuilder\AbstractCssStyle;
use App\Domain\Brand\CssStyleBuilder\CssStyle;
use App\Domain\Brand\CssStylesCollection\Base\CssStylesCollection;
use Illuminate\Support\Collection;

class ImageClasses extends CssStylesCollection
{
	public function getCssStyles(): Collection
	{
		$sizes = collect(['16', '24', '32', '40', '48', '56', '64', '96', '128', '156', '168', '256']);
		
		$cssStyles = $sizes->map(function ($size) {
			return new CssStyle('is-' . $size . 'x' . $size,
				[
					[
						'key' => 'width',
						'value' => $size . 'px',
					],
					[
						'key' => 'height',
						'value' => $size . 'px',
					],
				]);
		});
		
		$spacings = [0, 4, 8, 12];
		
		$base = 16;
		
		while ($base <= 208) {
			$spacings[] = $base;
			
			$base += 8;
		}
		
		$spacingBase = 25;
		
		while ($spacingBase <= 300) {
			$spacings[] = $spacingBase;
			
			$spacingBase += 25;
		}
		
		
		$pixels = collect(array_merge($spacings, ['160', '170', '200', '215', '197', '225', '228', '250', '300', '350', '385', '400', '450', '485', '500', '550', '600', '650', '700', '750', '800', '900', '950', '1000']));
		
		$res = $pixels->map(function ($size) {
			return new CssStyle('has-height-' . $size,
				[
					[
						'key' => 'height',
						'value' => $size . 'px',
					],
				]);
		});
		
		$cssStyles = $cssStyles->concat($res);
		
		$res = $pixels->map(function ($size) {
			return new CssStyle('has-min-height-' . $size,
				[
					[
						'key' => 'min-height',
						'value' => $size . 'px',
					],
				]);
		});
		
		$cssStyles = $cssStyles->concat($res);
		
		$res = $pixels->map(function ($size) {
			return new CssStyle('has-max-height-' . $size,
				[
					[
						'key' => 'max-height',
						'value' => $size . 'px',
					],
				]);
		});
		
		$cssStyles = $cssStyles->concat($res);
		
		
		$res = $pixels->map(function ($size) {
			return new CssStyle('has-max-width-' . $size,
				[
					[
						'key' => 'max-width',
						'value' => $size . 'px',
					],
				]);
		});
		
		$cssStyles = $cssStyles->concat($res);
		
		$res = $pixels->map(function ($size) {
			return new CssStyle('has-min-width-' . $size,
				[
					[
						'key' => 'min-width',
						'value' => $size . 'px',
					],
				]);
		});
		
		$cssStyles = $cssStyles->concat($res);
		
		$cssStyles->add((new CssStyle('has-height-auto'))
			->addStyle('height', 'auto'));
		
		return Collection::make($cssStyles);
	}
	
	public function usesSuffix()
	{
		return true;
	}
}
