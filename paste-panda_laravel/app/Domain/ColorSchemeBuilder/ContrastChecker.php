<?php

namespace App\Domain\ColorSchemeBuilder;

use App\ColorContrast\Color;
use App\ColorContrast\ColorItemV2;

class ContrastChecker
{
    public static function isDark($hex): bool
    {
        $color = new Color($hex);

        return $color->isDark();
    }

    public static function getBestContrast($background, $hex1, $hex2): string
    {
        $firstLuminosity = (new Color(str_replace('#', '', $background)))->getLuminance(new Color(str_replace('#', '', $hex1)));
        $secondLuminosity = (new Color(str_replace('#', '', $background)))->getLuminance(new Color(str_replace('#', '', $hex2)));

        if ($firstLuminosity >= $secondLuminosity) {
            return ColorItemV2::make($hex1)->toFullHex();
        }

        return ColorItemV2::make($hex2)->toFullHex();
    }
	
	public static function hasGoodLuminosity($background, $hex): bool
	{
		$firstLuminosity = (new Color(str_replace('#', '', $background)))->getLuminance(new Color(str_replace('#', '', $hex)));
		
		return $firstLuminosity >= 3;
	}
}
