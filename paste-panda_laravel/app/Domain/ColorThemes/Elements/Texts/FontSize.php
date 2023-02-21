<?php

namespace App\Domain\ColorThemes\Elements\Texts;

use App\Domain\ColorThemes\Elements\SimpleCssStyleFactory;

class FontSize extends SimpleCssStyleFactory
{
    public function property(): string
    {
        return 'font-size';
    }
}
