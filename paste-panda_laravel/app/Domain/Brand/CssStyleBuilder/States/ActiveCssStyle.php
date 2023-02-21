<?php

namespace App\Domain\Brand\CssStyleBuilder\States;

class ActiveCssStyle extends StatefulBase
{
    public function getName(): string
    {
        return 'active';
    }

    public function pseudo(): string
    {
        return 'active';
    }

    public function className(): string
    {
        return 'is-activated';
    }
}
