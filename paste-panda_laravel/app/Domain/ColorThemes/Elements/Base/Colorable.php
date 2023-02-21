<?php


namespace App\Domain\ColorThemes\Elements\Base;


interface Colorable
{
//	public static function getColorKeys($prefix = null) : array;
	public function getColorKeys($prefix = null) : array;
	
	public function getUsesAttributesAsKeys() : bool;
	
	public static function isBase() : bool;
	
//	public function getColorPage() : string;

	public function getColorFormulaKey() : ?string;

//	public static function getColorPageTitle() : string;
}
