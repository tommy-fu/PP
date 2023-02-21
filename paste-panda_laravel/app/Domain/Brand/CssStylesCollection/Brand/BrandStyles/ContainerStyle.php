<?php


namespace App\Domain\Brand\CssStylesCollection\Brand\BrandStyles;


use App\Domain\Brand\CssStyleBuilder\CssStyle;

class ContainerStyle extends CssStyle
{

	public function __construct($className)
	{
		parent::__construct($className);

		$this->addStyle('max-width', '1140px');
		$this->addStyle('margin', '0 auto');
	}
}
