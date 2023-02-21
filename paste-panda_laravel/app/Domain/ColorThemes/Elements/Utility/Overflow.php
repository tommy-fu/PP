<?php

namespace App\Domain\ColorThemes\Elements\Utility;

use App\Domain\ColorThemes\Elements\SimpleCssStyleFactory;

class Overflow extends SimpleCssStyleFactory
{
    public function property(): string
    {
        return 'overflow';
    }
}
