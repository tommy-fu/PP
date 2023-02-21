<?php

namespace App\Domain\ColorThemes\Elements\Utility\Typography;

use App\Domain\ColorThemes\Elements\SimpleCssStyleFactory;

class TextAlign extends SimpleCssStyleFactory
{
    public function property(): string
    {
        return 'text-align';
    }
}
