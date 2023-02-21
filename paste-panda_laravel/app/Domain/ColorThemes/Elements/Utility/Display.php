<?php

namespace App\Domain\ColorThemes\Elements\Utility;

use App\Domain\ColorThemes\Elements\SimpleCssStyleFactory;

class Display extends SimpleCssStyleFactory
{
    public function property(): string
    {
        return 'display';
    }
}
