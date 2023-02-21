<?php


namespace App\Domain\Brand\BrandBuilder;


use Illuminate\Support\Collection;

interface ICssStyleCollection
{
	public function getCollection() : Collection;
}
