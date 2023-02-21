<?php

namespace App\Domain\ColorThemes\Elements\Utility;

use App\Domain\ColorThemes\Elements\SimpleCssStyleFactory;

class MinHeight extends SimpleCssStyleFactory
{
    public function property(): string
    {
        return 'min-height';
    }
}
