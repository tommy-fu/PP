<?php


namespace App\Domain\ColorThemes\Elements\Utility;


use App\Domain\Brand\CssStyleBuilder\AbstractCssStyle;

interface ICssStyleFactory
{
	public static function make($selector, $value) : AbstractCssStyle;
	
//	public function property(): string;
}
