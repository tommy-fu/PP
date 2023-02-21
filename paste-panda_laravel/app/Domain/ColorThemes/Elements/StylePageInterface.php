<?php

namespace App\Domain\ColorThemes\Elements;

interface StylePageInterface
{
    public static function getStylePage() : string;

    public static function getStyleKeys() : array;
}
