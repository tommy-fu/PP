<?php


namespace App\Domain\ColorThemes\Elements\Utility\Flex;


use App\Domain\Brand\CssStyleBuilder\AbstractCssStyle;
use App\Domain\Brand\CssStyleBuilder\CssStyle;
use App\Domain\ColorThemes\Elements\SimpleCssStyleFactory;
use App\Domain\ColorThemes\Elements\Utility\ICssStyleFactory;

class Order extends SimpleCssStyleFactory
{
	public function property(): string
	{
		return 'order';
	}
}
