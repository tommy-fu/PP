<?php

namespace App\Domain\Brand\CssStyleBuilder\States;

use App\Domain\Brand\CssStyleBuilder\AbstractCssStyle;

interface Stateful
{
    public function getName() : string;

    public function pseudo() : string;

    public function className() : string;

    public function cssStyle($colorVariable, $attributes);

    public function generate($colorVariable, $attributes) : AbstractCssStyle;
}
