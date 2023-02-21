<?php


namespace App\Domain\Brand\CssStylesCollection;


use App\Domain\Brand\CssStylesCollection\Base\CssStylesCollection;
use App\Domain\Brand\CssStylesCollection\Keyframes\HueRotate;
use Illuminate\Support\Collection;

class KeyframesCollection extends CssStylesCollection
{
	public function getCssStyles(): Collection
	{
		return collect([
			HueRotate::make()
		]);
	}
}
