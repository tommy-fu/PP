<?php

namespace App\Domain\Brand\BrandBuilder\Scheme;

use App\Domain\Brand\CssStylesCollection\Brand\BrandStyles\ContainerStyle;
use Illuminate\Support\Collection;

class AddBaseClassToScheme
{
	public function handle()
	{
		$collection = new Collection();
		$collection->add(new ContainerStyle('container'));
		
		return $collection;
	}
}
