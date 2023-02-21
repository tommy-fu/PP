<?php

namespace App\Domain\Brand\CssStyleBuilder;

class ElementCssStyle extends AbstractCssStyle
{
	
	public function __construct($selector, $styles = [])
	{
		parent::__construct($selector, $styles);
		$this->setIsElement(true);
	}
}
