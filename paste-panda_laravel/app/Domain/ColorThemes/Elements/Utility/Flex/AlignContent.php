<?php

namespace App\Domain\ColorThemes\Elements\Utility\Flex;

use App\Domain\ColorThemes\Elements\SimpleCssStyleFactory;

class AlignContent extends SimpleCssStyleFactory
{
    public function property(): string
    {
        return 'align-content';
    }
}
