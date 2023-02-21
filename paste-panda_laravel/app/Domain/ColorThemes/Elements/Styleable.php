<?php


namespace App\Domain\ColorThemes\Elements;


interface Styleable
{
	public static function getStyleKeys();
	
	public function stylePage() : string;
	
	public function styleLabel() : string;
}
