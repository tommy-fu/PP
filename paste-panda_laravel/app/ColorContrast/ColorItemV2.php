<?php


namespace App\ColorContrast;


class ColorItemV2
{
	/**
	 * @var int
	 */
	protected $color = 0;
	
	
	public function __construct($hex = null)
	{
		if ($hex) {
			$hex = str_replace('#', '', $hex);
			$this->fromHex($hex);
		}
	}
	
	public static function make($hex = null): self
	{
		return new static($hex);
	}
	
	/**
	 * Init color from hex value
	 *
	 * @param string $hexValue
	 *
	 * @return ColorItemV2
	 */
	public function fromHex($hexValue): self
	{
		$this->color = hexdec($hexValue);
		
		return $this;
	}
	
	/**
	 * Get Hue/Saturation/Value for the current color
	 * (float values, slow but accurate)
	 *
	 * @return array
	 */
	public function toHsvFloat()
	{
		$rgb = $this->toRgbInt();
		
		$rgbMin = min($rgb);
		$rgbMax = max($rgb);
		
		$hsv = [
			'hue' => 0,
			'sat' => 0,
			'val' => $rgbMax,
		];
		
		// If v is 0, color is black
		if ($hsv['val'] == 0) {
			return $hsv;
		}
		
		// Normalize RGB values to 1
		$rgb['red'] /= $hsv['val'];
		$rgb['green'] /= $hsv['val'];
		$rgb['blue'] /= $hsv['val'];
		$rgbMin = min($rgb);
		$rgbMax = max($rgb);
		
		// Calculate saturation
		$hsv['sat'] = ($rgbMax - $rgbMin) * 100;
		if ($hsv['sat'] == 0) {
			$hsv['hue'] = 0;
			
			return $hsv;
		}
		
		// Normalize saturation to 1
		$rgb['red'] = ($rgb['red'] - $rgbMin) / ($rgbMax - $rgbMin);
		$rgb['green'] = ($rgb['green'] - $rgbMin) / ($rgbMax - $rgbMin);
		$rgb['blue'] = ($rgb['blue'] - $rgbMin) / ($rgbMax - $rgbMin);
		$rgbMin = min($rgb);
		$rgbMax = max($rgb);
		
		// Calculate hue
		if ($rgbMax == $rgb['red']) {
			$hsv['hue'] = 0.0 + 60 * ($rgb['green'] - $rgb['blue']);
			if ($hsv['hue'] < 0) {
				$hsv['hue'] += 360;
			}
		} elseif ($rgbMax == $rgb['green']) {
			$hsv['hue'] = 120 + (60 * ($rgb['blue'] - $rgb['red']));
		} else {
			$hsv['hue'] = 240 + (60 * ($rgb['red'] - $rgb['green']));
		}
		
		$hsv['val'] = $hsv['val'] / 255 * 100;
		
		return $hsv;
	}
	
	/**
	 * Convert color to RGB array (integer values)
	 *
	 * @return array
	 */
	public function toRgbInt()
	{
		return [
			'red' => (int)(255 & ($this->color >> 16)),
			'green' => (int)(255 & ($this->color >> 8)),
			'blue' => (int)(255 & ($this->color)),
		];
	}
	
	public function addHue(int $val)
	{
		$hsv = $this->toHsvFloat();
		
		$hue = intval(round($hsv['hue']));
		$sat = intval(round($hsv['sat']));
		$value = intval(round($hsv['val']));
		
		if (abs($val) > $hue) {
			$hue = 360 - (abs($val) - $hue);
		} else {
			$hue += $val;
		}

//		$this->HSVtoRGB($hue, $sat, $value/255*100);
		$this->HSVtoRGB($hue, $sat, $value);
		
		return $this;
	}
	
	public function HSVtoRGB($iH, $iS, $iV)
	{
		if ($iH < 0) {
			$iH = 0;
		}   // Hue:
		if ($iH > 360) {
			$iH = 360;
		} //   0-360
		if ($iS < 0) {
			$iS = 0;
		}   // Saturation:
		if ($iS > 100) {
			$iS = 100;
		} //   0-100
		if ($iV < 0) {
			$iV = 0;
		}   // Lightness:
		if ($iV > 100) {
			$iV = 100;
		} //   0-100
		
		$dS = $iS / 100.0; // Saturation: 0.0-1.0
		$dV = $iV / 100.0; // Lightness:  0.0-1.0
		$dC = $dV * $dS;   // Chroma:     0.0-1.0
		$dH = $iH / 60.0;  // H-Prime:    0.0-6.0
		$dT = $dH;       // Temp variable
		
		while ($dT >= 2.0) {
			$dT -= 2.0;
		} // php modulus does not work with float
		$dX = $dC * (1 - abs($dT - 1));     // as used in the Wikipedia link
		
		switch (floor($dH)) {
			case 0:
				$dR = $dC;
				$dG = $dX;
				$dB = 0.0;
				
				break;
			case 1:
				$dR = $dX;
				$dG = $dC;
				$dB = 0.0;
				
				break;
			case 2:
				$dR = 0.0;
				$dG = $dC;
				$dB = $dX;
				
				break;
			case 3:
				$dR = 0.0;
				$dG = $dX;
				$dB = $dC;
				
				break;
			case 4:
				$dR = $dX;
				$dG = 0.0;
				$dB = $dC;
				
				break;
			case 5:
				$dR = $dC;
				$dG = 0.0;
				$dB = $dX;
				
				break;
			default:
				$dR = 0.0;
				$dG = 0.0;
				$dB = 0.0;
				
				break;
		}
		
		$dM = $dV - $dC;
		$dR += $dM;
		$dG += $dM;
		$dB += $dM;
		$dR *= 255;
		$dG *= 255;
		$dB *= 255;
		
		
		$this->fromRgbInt(round($dR), round($dG), round($dB));
	}
	
	/**
	 * Init color from integer RGB values
	 *
	 * @param int $red
	 * @param int $green
	 * @param int $blue
	 *
	 * @return ColorItemV2
	 */
	public function fromRgbInt($red, $green, $blue): self
	{
		$this->color = (int)(($red << 16) + ($green << 8) + $blue);
		
		return $this;
	}
	
	
	public function getHue(): int
	{
		$hsv = $this->toHsvFloat();
		
		return intval(round($hsv['hue']));
	}
	
	public function getSaturation(): int
	{
		$hsv = $this->toHsvFloat();
		
		return intval(round($hsv['sat']));
	}
	
	public function getValue()
	{
		$hsv = $this->toHsvFloat();
		
		return intval(round($hsv['val']));
	}
	
	/**
	 * Convert color to hex
	 *
	 * @return string
	 */
	public function toHex()
	{
		return str_pad(dechex($this->color), 6, '0', STR_PAD_LEFT);
	}
	
	/**
	 * Alias of toString()
	 *
	 * @return string
	 */
	public function __toString()
	{
		return $this->toString();
	}
	
	/**
	 * Get color as string
	 *
	 * @return string
	 */
	public function toString()
	{
		$str = (string)$this->toHex();
		if (strlen($str) < 6) {
			$str = str_pad($str, 6, '0', STR_PAD_LEFT);
		}
		
		return strtoupper("#{$str}");
	}
	
	public function setSaturation($fixed_saturation): self
	{
		$hsv = $this->toHsvFloat();
		
		$hue = intval(round($hsv['hue']));
		$value = intval(round($hsv['val']));
		
		$this->HSVtoRGB($hue, $fixed_saturation, $value);
		
		return $this;
	}
	
	public function setBrightness($fixed_brightness)
	{
		$hsv = $this->toHsvFloat();
		
		$hue = intval(round($hsv['hue']));
		$sat = intval(round($hsv['sat']));
		$value = intval(round($hsv['val']));
//		dd($value);
//		dd($fixed_brightness);
		$this->HSVtoRGB($hue, $sat, $fixed_brightness);
		
		return $this;
	}
	
	public function alterBrightness($altered_brightness)
	{
		$hsv = $this->toHsvFloat();
		
		$hue = intval(round($hsv['hue']));
		$sat = intval(round($hsv['sat']));
		$value = intval(round($hsv['val']));
		
		$this->HSVtoRGB($hue, $sat, $value + $altered_brightness);
		
		return $this;
	}
	
	public function alterSaturation($altered_saturation)
	{
		$hsv = $this->toHsvFloat();
		
		$hue = intval(round($hsv['hue']));
		$sat = intval(round($hsv['sat']));
		$value = intval(round($hsv['val']));
		
		$this->HSVtoRGB($hue, $sat + $altered_saturation, $value);
	}
	
	public function toFullHex()
	{
		return strtoupper('#' . $this->toHex());
	}
	
	public function asRgba($opacity = '1')
	{
		$colors = $this->toRgbInt();
		return 'rgba(' . $colors['red'] . ', ' . $colors['green'] . ', ' . $colors['blue'] . ', ' . $opacity . ')';
	}
	
	public static function isHex($hex) : bool{
		try {
			new static($hex);
			
			return true;
		}
		catch (\Exception $e) {
			return false;
		}
	}
}
