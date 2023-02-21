<?php

namespace App\Domain\ColorThemes\Elements\Backgrounds;

use App\Domain\ColorThemes\Elements\SimpleCssStyleFactory;

class Background extends SimpleCssStyleFactory
{
    public function property(): string
    {
        return 'background';
    }
}
