<?php

namespace App\Domain\ColorThemes\Elements;

interface IColorVariable
{
    public static function makeColorVariables();

    public static function getKeys();

    public function hasFixedColorAttribute() : bool;
}
