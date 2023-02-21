<?php

namespace App\Domain\ColorThemes\Elements\Modifiers;

use App\Domain\ColorThemes\Elements\SimpleCssStyleFactory;

class BorderColor extends SimpleCssStyleFactory
{
    public function property(): string
    {
        return 'border-color';
    }
}
