<?php

namespace App\Color;

use MikeAlmond\Color\Exceptions\ColorException;

/**
 * Class CssGenerator
 * @package MikeAlmond\Color
 */
class CssGenerator
{

    /**
     * @param BaseColor $color
     *
     * @return string
     */
    public static function rgb(BaseColor $color)
    {
        return sprintf(
            'rgb(%d, %d, %d)',
            $color->getRgb()['r'],
            $color->getRgb()['g'],
            $color->getRgb()['b']
        );
    }

    /**
     * @param BaseColor $color
     * @param float $alpha
     *
     * @return string
     */
    public static function rgba(BaseColor $color, $alpha = 1.0)
    {
        return sprintf(
            'rgba(%d, %d, %d, %s)',
            $color->getRgb()['r'],
            $color->getRgb()['g'],
            $color->getRgb()['b'],
            $alpha + 0
        );
    }

    /**
     * @param BaseColor $color
     *
     * @return string
     */
    public static function hex(BaseColor $color)
    {
        return '#' . $color->getHex();
    }

    /**
     * @param BaseColor $color
     *
     * @return string
     */
    public static function hsl(BaseColor $color)
    {
        $hsl = $color->getHsl();

        return sprintf(
            'hsl(%s, %s%%, %s%%)',
            sprintf('%0.1f', $hsl['h'] * 360) + 0,
            sprintf('%0.1f', $hsl['s'] * 100) + 0,
            sprintf('%0.1f', $hsl['l'] * 100) + 0
        );
    }

    /**
     * @param BaseColor $color
     * @param float $alpha
     *
     * @return string
     */
    public static function hsla(BaseColor $color, float $alpha = 1.0)
    {
        $hsl = $color->getHsl();

        return sprintf(
            'hsla(%s, %s%%, %s%%, %s)',
            sprintf('%0.1f', $hsl['h'] * 360) + 0,
            sprintf('%0.1f', $hsl['s'] * 100) + 0,
            sprintf('%0.1f', $hsl['l'] * 100) + 0,
            $alpha + 0
        );
    }

    /**
     * @param \MikeAlmond\Color\Color $color
     *
     * @return bool
     */
    public static function hasName(BaseColor $color): bool
    {
        return isset(X11Colors::$colors[$color->getHex()]);
    }

    /**
     * @param \MikeAlmond\Color\Color $color
     *
     * @return string
     */
    public static function name(BaseColor $color): string
    {
        if (!self::hasName($color)) {
            throw new ColorException('No matching CSS color name found for ' . self::hex($color));
        }

        return X11Colors::$colors[$color->getHex()][0];
    }
}
