<?php

namespace App\Services;


class CssServices
{
	
	public static function getCssStyle($key, $value)
	{
		if (!$key || !$value && !is_string($value)) return '';
		return $key . ': ' . $value . ';' . PHP_EOL;
	}
}
