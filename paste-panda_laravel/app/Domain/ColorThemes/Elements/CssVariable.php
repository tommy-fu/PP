<?php

namespace App\Domain\ColorThemes\Elements;

class CssVariable
{
    public static function make($key) : array
    {
        return ['key' => $key];
    }
}
