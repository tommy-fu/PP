<?php

namespace App\Domain\Brand\BrandBuilder;

use Illuminate\Support\Collection;

class BrandDirector
{
	public function make(IBrandBuilder $builder): Collection
	{
		return $builder->getCollection();
	}
	
	public function makeModifiers(IBrandBuilder $builder, $className, $prefix): Collection
	{
		return $builder->getCollection();
	}
}
