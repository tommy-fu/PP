<?php

namespace App\Domain\ColorThemes\Elements\Utility\Spacing;

use App\Domain\ColorThemes\Elements\SimpleCssStyleFactory;

class MarginRight extends SimpleCssStyleFactory
{
    public function property(): string
    {
        return 'margin-right';
    }
}
