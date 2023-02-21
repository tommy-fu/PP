<?php


namespace App\Domain\Brand\CssStylesCollection\Reset;

use App\Domain\Brand\CssStylesCollection\Base\CssStylesCollection;
use Illuminate\Support\Collection;

class Normalizer extends CssStylesCollection
{
	
	public function getCssString(): string
	{
		return file_get_contents(resource_path('css/normalize.css'));
	}
	
	public function getCssStyles(): Collection
	{
		return new Collection();
	}
}
