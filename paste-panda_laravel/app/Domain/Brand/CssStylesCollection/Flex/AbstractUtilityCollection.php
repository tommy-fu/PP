<?php


namespace App\Domain\Brand\CssStylesCollection\Flex;


use Illuminate\Support\Collection;

class AbstractUtilityCollection
{
	public static function getCollection() : Collection{
		return collect(static::$items)
			->map(function ($value) {
				return static::$model::make(static::$prefix . $value, $value);
			});
	}
}
