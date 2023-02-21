<?php

namespace App\Domain\SchemeFormula;

use App\Domain\Brand\BrandVariables;
use App\Domain\ColorThemes\Elements\Base\Colorable;

class SchemeFormulaBase
{
    /**
     * @return array
     */
    public static function generateColorVariables(): array
    {
        $variables = BrandVariables::$styleVariables;

        $foo = collect($variables)
            ->filter(function ($variable) {
                return is_subclass_of($variable, Colorable::class);
            })
            ->flatMap(function ($variable) {
                return $variable::getFormulaKeys();
            });

        $res = [];

        foreach ($foo as $key) {
            $res[$key] = [
                'fixed_value' => null,
                'fixed_hex' => null,
                'fixed_hue' => null,
                'fixed_saturation' => null,
                'fixed_brightness' => null,
                'altered_saturation' => null,
                'altered_brightness' => null,
            ];
        }

        return $res;
    }
}
