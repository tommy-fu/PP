<?php

namespace App\Domain\ColorThemes;

use App\Domain\ColorThemes\Mock\ColorSchemeMock;

class Colors
{
    public static function make($color)
    {
        return isset(app('colors')[$color]) ? app('colors')[$color] : '';
    }

    public static function getPropertyByAttribute($attribute)
    {
        $lookup = [
            'text' => 'color',
            'inset-box-shadow' => 'box-shadow',
        ];

        return array_key_exists($attribute, $lookup) ? $lookup[$attribute] : $attribute;
    }

    public static function setScheme($scheme)
    {
        app()->singleton('colors', function () use ($scheme) {
            $mock = new ColorSchemeMock();

            $scheme->colors = array_intersect_key($scheme->colors, $mock->getVariables()->toArray()) + $mock->getVariables()->toArray();

            return $scheme->colors;
        });
    }

    public static function initialize($overrides = [])
    {
        app()->singleton('colors', function () use ($overrides) {
            $mock = new ColorSchemeMock();

            return array_intersect_key($overrides, $mock->getVariables()->toArray()) + $mock->getVariables()->toArray();
        });
    }
}
