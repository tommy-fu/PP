<?php

namespace App\SchemeBuilder;

use App\ColorContrast\Color;

abstract class SchemeComponentsGenerator implements ISchemeComponentsGenerator
{

    public function __construct($hex, &$scheme, String $background, $key = '')
    {
        $color = new Color();

        $this->color = $color->fromHex($hex);
        $this->hex = $hex;
        $this->scheme = $scheme;
        $this->key = $key;
        $this->background = $background;
    }

    public static function generate($hex, &$scheme, $background, $key = '')
    {
        $class = get_called_class();
        $button = new $class($hex, $scheme, $background, $key);

        $scheme = $button->apply();
    }

    public function setSchemeColor($key, $hex)
    {
        $this->scheme[$this->key . $key] = strtoupper('#' . $hex);
    }

    public function setSchemeValue($key, $hex)
    {
        $this->scheme[$this->key . $key] = $hex;
    }
	
	public function hasDarkBackground(){
    	$color = new Color($this->background);
    	
    	return $color->isDark();
    }
	
	public function hasLightBackground(){
		$color = new Color($this->background);
		
		return $color->isLight();
	}
	
	public function shouldApplyDarkTextOnBackground(){
		return (new Color($this->background))->getLuminance(new Color('000000')) > (new Color($this->background))->getLuminance(new Color('ffffff'));
	}
	
	public function shouldApplyLightTextOnBackground(){
		return (new Color($this->background))->getLuminance(new Color('000000')) <= (new Color($this->background))->getLuminance(new Color('ffffff'));
	}
}
