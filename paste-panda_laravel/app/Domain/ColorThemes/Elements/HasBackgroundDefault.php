<?php

namespace App\Domain\ColorThemes\Elements;

use App\Domain\ColorThemes\Colors;
use App\Domain\ColorThemes\Elements\Backgrounds\Background;

class HasBackgroundDefault
{
	public static $baseStyles = [];
	
	public static function makeCssStyle($prefix = null)
	{
		$hrColorVariable = $prefix ? $prefix . '_' . 'background' : 'background';
		
		return Background::make('has-bg-default', Colors::make($hrColorVariable));
	}
}
