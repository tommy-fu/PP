<?php

namespace App\Domain\ColorThemes\Elements\Modifiers;

use App\Domain\ColorThemes\Elements\SimpleCssStyleFactory;

class TextModifier extends SimpleCssStyleFactory
{
    public function property(): string
    {
        return 'color';
    }
}
