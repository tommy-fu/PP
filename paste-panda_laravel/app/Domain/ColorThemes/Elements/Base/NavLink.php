<?php

namespace App\Domain\ColorThemes\Elements\Base;

use App\Domain\ColorThemes\Elements\CssVariable;
use App\Domain\ColorThemes\Elements\IColorVariable;
use App\Domain\ColorThemes\Elements\IStyleVariable;
use App\Domain\ColorThemes\Elements\Styleable;
use App\Domain\ColorThemes\Elements\StyleableTrait;

class NavLink extends LinkBase implements IColorVariable, IStyleVariable, Styleable, Colorable
{
    use ColorableTrait;
    use StyleableTrait;

    public function items() : array
    {
        return [
            CssVariable::make('nav_link'),
        ];
    }

    public function stylePage(): string
    {
        return 'links';
    }

    public function styleType(): string
    {
        return 'links';
    }

    public function styleLabel(): string
    {
        return 'Nav links';
    }

    public function getColorFormulaKey(): ?string
    {
        return 'nav_link';
    }
}
