<?php

namespace App\Domain\Brand\CssStyleBuilder\States;

use App\Domain\Brand\CssStyleBuilder\AbstractCssStyle;
use App\Domain\Brand\CssStyleBuilder\CssStyle;
use App\Domain\ColorThemes\Colors;

class CardHoverable extends StatefulBase
{
    private $cssStyle;

    public function cssStyle($colorVariable = null, $attributes = []): AbstractCssStyle
    {
        $this->cssStyle = (new HoverCssStyle())->cssStyle($colorVariable, $attributes);
        $this->cssStyle->addStyle('background', Colors::make('card_hover-background'));

        return $this->cssStyle;
    }

    public function generate($colorVariable = null, $attributes = []): AbstractCssStyle
    {
        $cssStyle = new CssStyle('is-hoverable');

        $cssStyle->addAdditionalStyle($this->cssStyle($colorVariable, $attributes));

        return $cssStyle;
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
