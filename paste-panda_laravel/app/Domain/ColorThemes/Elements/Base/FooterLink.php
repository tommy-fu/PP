<?php

namespace App\Domain\ColorThemes\Elements\Base;

use App\Domain\ColorThemes\Elements\CssVariable;
use App\Domain\ColorThemes\Elements\IColorVariable;
use App\Domain\ColorThemes\Elements\IStyleVariable;
use App\Domain\ColorThemes\Elements\Styleable;
use App\Domain\ColorThemes\Elements\StyleableTrait;

class FooterLink extends LinkBase implements IColorVariable, IStyleVariable, Styleable, Colorable
{
    use ColorableTrait;
    use StyleableTrait;

    public function preferredVariables() : array
    {
        return [];
    }

    public function items(): array
    {
        return [
            CssVariable::make('footer_link'),
        ];
    }

    public function stylePage(): string
    {
        return 'links';
    }

    public function styleLabel(): string
    {
        return 'Footer links';
    }

    public function getColorFormulaKey(): ?string
    {
        return 'footer_link';
    }
}
