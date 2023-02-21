<?php


namespace App\Domain\ColorThemes\Elements\Utility;


use App\Domain\Brand\CssStyleBuilder\AbstractCssStyle;
use App\Domain\Brand\CssStyleBuilder\CssStyle;
use App\Domain\ColorThemes\Elements\SimpleCssStyleFactory;

class Width extends SimpleCssStyleFactory
{
	public function property(): string
	{
		return 'width';
	}
}
