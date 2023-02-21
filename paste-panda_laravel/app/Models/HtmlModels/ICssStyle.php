<?php


namespace App\Models\HtmlModels;


use App\Domain\Brand\CssStyleBuilder\CssStyleResult;

interface ICssStyle
{
	public function getClassCssString(CssStyleResult $cssStyleResult, $selector = ''): void;
//	function getClassCssStringForTablet();

//	public function getStyles(): array;
//	public function getTabletStyles(): array;
//	public function getDesktopStyles(): array;
//	public function addStyles($styles);
//
//	public function addStyle($key, $value);
//	public function addDesktopStyles($key, $value);
//	public function addTabletStyles($key, $value);
}
