<?php

namespace App\Color;


use App\Color\Exceptions\ColorException;
use App\Color\Exceptions\InvalidColorException;

/**
 * Class Color
 * @package MikeAlmond\Color
 */
class BaseColor implements \JsonSerializable
{

    /**
     * @var int[]
     */
    private $colors = [
        'r' => 0,
        'g' => 0,
        'b' => 0,
    ];

    /**
     * Create a new Skeleton Instance
     *
     * @param int $red
     * @param int $green
     * @param int $blue
     */
    private function __construct(int $red, int $green, int $blue)
    {
        $this->colors = [
            'r' => $red,
            'g' => $green,
            'b' => $blue,
        ];
    }

    /**
     * @param string $color
     *
     * @return BaseColor
     */
    public static function fromHex(string $color): BaseColor
    {
        if (!Validator::isValidHex($color)) {
            throw new InvalidColorException('Invalid hex value');
        }

        return new self(...array_values(self::hexToRgb($color)));
    }

    /**
     * @param int $red
     * @param int $green
     * @param int $blue
     *
     * @return BaseColor
     */
    public static function fromRgb(int $red, int $green, int $blue): BaseColor
    {
        if (!Validator::isValidRgb($red, $green, $blue)) {
            throw new InvalidColorException('Invalid RGB values');
        }

        return new self($red, $green, $blue);
    }

    /**
     * @param float $hue
     * @param float $saturation
     * @param float $lightness
     *
     * @return BaseColor
     */
    public static function fromHsl(float $hue, float $saturation, float $lightness): BaseColor
    {
        if (!Validator::isValidHsl($hue, $saturation, $lightness)) {
            throw new InvalidColorException('Invalid HSL value');
        }

        return new self(...array_values(self::hslToRgb($hue, $saturation, $lightness)));
    }

    /**
     * @param string $color
     *
     * @return BaseColor
     */
    public static function fromCssColor(string $color): BaseColor
    {
        return self::fromHex(X11Colors::search($color));
    }

    /**
     * @param string $color
     *
     * @return array
     */
    private static function hexToRgb(string $color): array
    {
        $color = ltrim($color, '#');

        // Convert the shorthand hex to the full hex (09F => 0099FF)
        if (strlen($color) == 3) {
            $color = $color[0] . $color[0] . $color[1] . $color[1] . $color[2] . $color[2];
        }

        return [
            'r' => (int)hexdec(substr($color, 0, 2)),
            'g' => (int)hexdec(substr($color, 2, 2)),
            'b' => (int)hexdec(substr($color, 4, 2)),
        ];
    }

    /**
     * Converts an HSL hue to it's RGB value.
     *
     * Thanks to Easy RGB for this function (Hue_2_RGB).
     * http://www.easyrgb.com/index.php?X=MATH&$h=19#text19
     * http://stackoverflow.com/questions/2353211/hsl-to-rgb-color-conversion
     *
     * @param float $p   Temporary based on whether the luminance is less than 0.5, and
     *                   calculated using the saturation and luminance values.
     * @param float $q
     * @param float $hue The hue (to be converted to an RGB value)  For red, add 1/3 to the hue, green
     *                   leave it alone, and blue you subtract 1/3 from the hue.
     *
     * @return mixed
     */
    private static function hueToRgb($p, $q, $hue): float
    {
        if ($hue < 0) {
            $hue += 1;
        }
        if ($hue > 1) {
            $hue -= 1;
        }

        if ($hue < 1 / 6) {
            return $p + ($q - $p) * 6 * $hue;
        }
        if ($hue < 1 / 2) {
            return $q;
        }
        if ($hue < 2 / 3) {
            return $p + ($q - $p) * (2 / 3 - $hue) * 6;
        }

        return $p;
    }

    /**
     * Converts an HSL color value to RGB.
     *
     * Conversion formula adapted from http://www.niwa.nu/2013/05/math-behind-colorspace-conversions-rgb-hsl/
     * and http://stackoverflow.com/questions/2353211/hsl-to-rgb-color-conversion
     *
     * Assumes h, s, and l are in the set [0-1]
     *
     * @param float $hue
     * @param float $saturation
     * @param float $lightness
     *
     * @return array
     */
    private static function hslToRgb(float $hue, float $saturation, float $lightness): array
    {
        // If saturation is 0, the given color is grey and only
        // lightness is relevant.
        if ($saturation == 0) {
            $lightness = (int)ceil($lightness * 255);

            return ['r' => $lightness, 'g' => $lightness, 'b' => $lightness];
        }

        // Calculate some temporary variables to make the calculation easier
        $q = $lightness < 0.5
            ? $lightness * (1 + $saturation)
            : $lightness + $saturation - $lightness * $saturation;

        $p = 2 * $lightness - $q;

        // Run the calculated vars through hueToRgb to calculate the RGB value. Note that for the Red
        // value, we add a third (120 degrees), to adjust the hue to the correct section of the circle for red.
        // Similarity, for blue, we subtract 1/3.
        $red   = self::hueToRgb($p, $q, $hue + 1 / 3);
        $green = self::hueToRgb($p, $q, $hue);
        $blue  = self::hueToRgb($p, $q, $hue - 1 / 3);

        return [
            'r' => (int)round($red * 255, 2),
            'g' => (int)round(round($green, 2) * 255),
            'b' => (int)round($blue * 255, 2),
        ];
    }

    /**
     * Checks to see if body text on a background color is readable based on WCAG2 standards
     *
     * WCAG 2 level AA requires a contrast ratio of at least 4.5:1 for normal text and 3:1 for large text.
     * Level AAA requires a contrast ratio of at least 7:1 for normal text and 4.5:1 for large text.
     *
     * Large text is defined as 14 point (typically 18.66px) and bold or larger, or 18 point (typically 24px) or larger.
     *
     * @param BaseColor  $backgroundColor
     * @param string $level
     * @param int    $fontSize
     *
     * @return bool
     */
    public function isReadable(BaseColor $backgroundColor, $level = 'AA', int $fontSize = 12): bool
    {
        $contrast = round($this->luminosityContrast($backgroundColor), 2);

        // Normal text
        if ($fontSize < 19) {
            return $contrast >= ($level === 'AA' ? 4.5 : 7.1);
        }

        return $contrast >= ($level === 'AA' ? 3.0 : 4.5);
    }

    /**
     * @return bool
     */
    public function isDark(): bool
    {
        return $this->getBrightness() < 136;
    }

    /**
     * @param BaseColor $color
     *
     * @return bool
     */
    public function equals(BaseColor $color): bool
    {
        return $this->getHex() == $color->getHex();
    }

    /**
     * Get's the luminosity contrast based on the sRGB color space
     * https://www.w3.org/TR/WCAG20/#relativeluminancedef
     *
     * @return float
     */
    public function getLuminosity(): float
    {
        $rSrgb = $this->colors['r'] / 255;
        $gSrgb = $this->colors['g'] / 255;
        $bSrgb = $this->colors['b'] / 255;

        $r = $rSrgb <= 0.03928 ? $rSrgb / 12.92 : pow(($rSrgb + 0.055) / 1.055, 2.4);
        $g = $gSrgb <= 0.03928 ? $gSrgb / 12.92 : pow(($gSrgb + 0.055) / 1.055, 2.4);
        $b = $bSrgb <= 0.03928 ? $bSrgb / 12.92 : pow(($bSrgb + 0.055) / 1.055, 2.4);

        return (0.2126 * $r) + (0.7152 * $g) + (0.0722 * $b);
    }

    /**
     * Based on the W3C working draft on accessibility's brightness formula
     * https://www.w3.org/TR/AERT#color-contrast
     *
     * @return float
     */
    public function getBrightness(): float
    {
        return (($this->colors['r'] * 299) + ($this->colors['g'] * 587) + ($this->colors['b'] * 114)) / 1000;
    }

    /**
     * @param BaseColor $color
     *
     * @return int
     *@deprecated use `luminosityContrast` instead
     *
     * This works by summing up the differences between the three color components red, green and blue.
     * A value higher than 500 is recommended for good readability.
     *
     */
    public function colorDifference(BaseColor $color): int
    {
        $color2 = $color->getRgb();

        return (int)abs($this->colors['r'] - $color2['r'])
            + (int)abs($this->colors['g'] - $color2['g'])
            + (int)abs($this->colors['b'] - $color2['b']);
    }

    /**
     * @param BaseColor $color
     *
     * @return float
     *@deprecated use `luminosityContrast` instead
     *
     * This function tries to compare the brightness of the colors. A return value of
     * more than 125 is recommended. Combining it with the color difference above might make sense.
     *
     */
    public function brightnessDifference(BaseColor $color): float
    {
        $difference = $this->getBrightness() - $color->getBrightness();

        if ($difference < 0) {
            $difference *= -1.0;
        }

        return $difference;
    }

    /**
     * Uses the luminosity to calculate the difference between the given colors.
     * The returned value should be larger than 4.5 for best readability.
     *
     * @param BaseColor $color
     *
     * @return float
     */
    public function luminosityContrast(BaseColor $color): float
    {
        $colorLuminosity1 = $this->getLuminosity() + 0.05;
        $colorLuminosity2 = $color->getLuminosity() + 0.05;

        return max($colorLuminosity1, $colorLuminosity2) / min($colorLuminosity1, $colorLuminosity2);
    }

    /**
     * @param BaseColor $color
     * @param float $percentage A number between 0 and 1
     *
     * @return BaseColor
     */
    public function mix(BaseColor $color, float $percentage = 50)
    {
        $steps     = 2;
        $weight    = ($percentage * $steps) / 100;
        $mixWeight = $steps - $weight;

        $mixedColor = [
            'r' => (int)ceil((($this->getRgb()['r'] * $weight) + ($color->getRgb()['r'] * $mixWeight)) / $steps),
            'g' => (int)ceil((($this->getRgb()['g'] * $weight) + ($color->getRgb()['g'] * $mixWeight)) / $steps),
            'b' => (int)ceil((($this->getRgb()['b'] * $weight) + ($color->getRgb()['b'] * $mixWeight)) / $steps),
        ];

        return new self(...array_values($mixedColor));
    }

    /**
     * @return string
     */
    public function getHex(): string
    {
        return sprintf(
            '%02X%02X%02X',
            $this->colors['r'],
            $this->colors['g'],
            $this->colors['b']
        );
    }

    /**
     * @return int[]
     */
    public function getRgb(): array
    {
        return $this->colors;
    }

    /**
     * Converts RGB color to HSL color
     * @see http://en.wikipedia.org/wiki/HSL_and_HSV#Hue_and_chroma
     *
     * @return array
     */
    public function getHsl(): array
    {
        $red   = $this->colors['r'] / 255;
        $green = $this->colors['g'] / 255;
        $blue  = $this->colors['b'] / 255;

        // Determine lowest & highest value and chroma
        $max    = max($red, $green, $blue);
        $min    = min($red, $green, $blue);
        $chroma = $max - $min;

        // Calculate Luminosity
        $lightness = ($max + $min) / 2;

        // If chroma is 0, the given color is grey
        // therefore hue and saturation are set to 0
        if ($chroma == 0) {
            return ['h' => 0, 's' => 0, 'l' => $lightness];
        }

        $saturation = $lightness > 0.5
            ? $chroma / (2 - $max - $min)
            : $chroma / ($max + $min);

        switch ($max) {
            case $red:
                $hue = ($green - $blue) / $chroma + ($green < $blue ? 6 : 0);
                break;

            case $green:
                $hue = ($blue - $red) / $chroma + 2;
                break;

            case $blue:
            default:
                $hue = ($red - $green) / $chroma + 4;
                break;
        }

        $hue /= 6;

        // Return HSL Color as array
        return [
            'h' => $hue,
            's' => $saturation,
            'l' => $lightness,
        ];
    }

    /**
     * @param string $default
     *
     * @return BaseColor
     */
    public function getMatchingTextColor($default = 'CCCCCC')
    {
        // Always set black's matching text color to the default
        if ($this->getHsl()['l'] == 0) {
            return self::fromHex($default);
        }

        if ($this->isDark()) {
            $color = $this->lighten(125);
            $count = 1;
            do {
                $color = $color->lighten(20);
                $count++;
            } while (!$this->isReadable($color) && $count < 100);

            return $color;
        }

        $color = $this->darken(100);
        $count = 1;
        do {
            $color = $color->darken(10);
            $count++;
        } while (!$this->isReadable($color) && $count < 100);

        return $color;
    }

    /**
     * @param float $percentage
     *
     * @return BaseColor
     */
    public function darken(float $percentage): BaseColor
    {
        $colors      = $this->getHsl();
        $colors['l'] -= $colors['l'] * ($percentage / 100);

        $darkerColor = self::hslToRgb($colors['h'], $colors['s'], max(round($colors['l'], 5), 0));

        return new self(...array_values($darkerColor));
    }

    /**
     * @param float $percentage
     *
     * @return BaseColor
     */
    public function lighten(float $percentage): BaseColor
    {
        $colors      = $this->getHsl();
        $colors['l'] += $colors['l'] * ($percentage / 100);

        $lighterColor = self::hslToRgb($colors['h'], $colors['s'], min(round($colors['l'], 5), 1));

        return new self(...array_values($lighterColor));
    }

    /**
     * @param float $degrees
     *
     * @return BaseColor
     */
    public function adjustHue(float $degrees = 30): BaseColor
    {
        if (!Validator::isValidAdjustment($degrees)) {
            throw new ColorException('You must specify a proper value between 360 and -360');
        }

        $colors = $this->getHsl();

        // Convert the hue to degrees and add the adjustment
        $hue = ($colors['h'] * 360) + $degrees;

        if ($hue >= 360) {
            $hue -= 360;
        } elseif ($hue < 0) {
            $hue += 360;
        }

        $adjustedColor = self::hslToRgb($hue / 360, $colors['s'], $colors['l']);

        return new self(...array_values($adjustedColor));
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getHex();
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return $this->colors;
    }
}
