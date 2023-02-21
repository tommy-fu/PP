<?php


namespace App\Domain\Brand\BrandBuilder;


use Illuminate\Support\Collection;

interface IBrandBuilder
{
//	function reset() : self;
//	function addBrandModifiers($className, $prefix) : self;
	function getCollection() : Collection;
}
