<?php

namespace App\Domain\Brand\CssStylesCollection\Icons;

class IconCss
{
	public function getCssString(): string
	{
		//Font path
		$font = app('brand')->getIconCss();
		
		$font .= $this->getStr();
		
		//Todo: Depends on brand, and should be moved to an own CSS file
		$font .= app('brand')->getIconCodes();
		
		return $font;
	}
	
	/**
	 * @return string
	 */
	private function getStr(): string
	{
		return '
 [class^="icon-"]:before, [class*=" icon-"]:before {
  font-family: "icons";
  font-style: normal;
  font-weight: normal;
}
' . PHP_EOL;
	}
}
