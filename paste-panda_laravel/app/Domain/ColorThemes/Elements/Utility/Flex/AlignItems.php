<?php

namespace App\Domain\ColorThemes\Elements\Utility\Flex;

use App\Domain\ColorThemes\Elements\SimpleCssStyleFactory;

class AlignItems extends SimpleCssStyleFactory
{
    public function property(): string
    {
        return 'align-items';
    }
}
