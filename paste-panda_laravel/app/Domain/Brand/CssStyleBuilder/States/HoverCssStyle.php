<?php

namespace App\Domain\Brand\CssStyleBuilder\States;

class HoverCssStyle extends StatefulBase
{
    public function baseStyles(): array
    {
        return [
            'transition' => '0.2s'
        ];
    }

    public function getName(): string
    {
        return 'hover';
    }

    public function pseudo(): string
    {
        return 'hover';
    }

    public function className(): string
    {
        return 'is-hovered';
    }
}
