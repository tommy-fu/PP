<?php

namespace App\Domain\Brand\BrandBuilder;

use App\Domain\Brand\CssStyleBuilder\CssStyle;
use App\Domain\Brand\CssStyleBuilder\Viewports\DesktopCssStyle;
use App\Domain\Brand\CssStyleBuilder\Viewports\TabletCssStyle;

class CardBodyCssStyle extends CssStyle
{
	public function __construct($selector, $brandItemName)
	{
		parent::__construct($selector);
		
		$brand = app('brand')->variables;
		
		$styleItem = $brand[$brandItemName];
		
		$this->addStyle('position', 'relative');
		$this->addStyle('z-index', '2');
		
		$this->addStylesFromKeyValue([
			'padding' => $styleItem['mobile_styles']['padding'],
		]);
		
		$this->addToViewports((new TabletCssStyle($selector))
			->addStylesFromKeyValue([
				'padding' => $styleItem['tablet_styles']['padding'],
			]));
		
		$this->addToViewports((new DesktopCssStyle($selector))
			->addStylesFromKeyValue([
				'padding' => $styleItem['desktop_styles']['padding'],
			]));
	}
}
