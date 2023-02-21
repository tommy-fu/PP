<?php

namespace App\Domain\ColorThemes\Elements\Utility\Flex;

use App\Domain\ColorThemes\Elements\SimpleCssStyleFactory;

class FlexGrow extends SimpleCssStyleFactory
{
    public function property(): string
    {
        return 'flex-grow';
    }
}
