<?php

namespace App\Domain\ColorThemes\Elements\Base;

use App\Domain\ColorThemes\Elements\CssVariable;
use App\Domain\ColorThemes\Elements\IColorVariable;
use App\Domain\ColorThemes\Elements\IStyleVariable;
use App\Domain\ColorThemes\Elements\Styleable;
use App\Domain\ColorThemes\Elements\StyleableTrait;

class Link extends LinkBase implements IColorVariable, IStyleVariable, Styleable, Colorable
{
    use StyleableTrait;
    use ColorableTrait;

    public static $sectionId = 107;

    public function items() : array
    {
        return [
            CssVariable::make('link_xl'),
            CssVariable::make('link_lg'),
            CssVariable::make('link_md'),
            CssVariable::make('link_sm'),
            CssVariable::make('link_xs'),
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
        return 'Links';
    }

    public function getColorFormulaKey(): ?string
    {
        return 'link';
    }
}
