<?php


namespace App\Domain\Brand\BrandBuilder\Creators;


use App\Domain\Brand\BrandBuilder\BrandBuilderConfig;

interface BaseCreatorInterface
{
	public static function make(BrandBuilderConfig $brandBuilderConfig);
}
