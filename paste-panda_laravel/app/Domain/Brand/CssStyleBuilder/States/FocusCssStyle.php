<?php

namespace App\Domain\Brand\CssStyleBuilder\States;

class FocusCssStyle extends StatefulBase
{
    public function getName(): string
    {
        return 'focus';
    }

    public function pseudo(): string
    {
        return 'focus';
    }

    public function className(): string
    {
        return 'is-focused';
    }
}
