<?php

namespace App\Domain\ColorThemes\Elements\Base;

use App\Domain\ColorThemes\Elements\CssVariable;
use App\Domain\ColorThemes\Elements\IColorVariable;
use App\Domain\ColorThemes\Elements\IStyleVariable;
use App\Domain\ColorThemes\Elements\Styleable;
use App\Domain\ColorThemes\Elements\StyleableTrait;

class SolidButton extends BaseButton implements IColorVariable, IStyleVariable, Styleable, Colorable
{
    use StyleableTrait;
    use ColorableTrait;

    public function items(): array
    {
        return [
            CssVariable::make('button_xl'),
            CssVariable::make('button_lg'),
            CssVariable::make('button'),
            CssVariable::make('button_md'),
            CssVariable::make('button_sm'),
            CssVariable::make('button_xs'),
        ];
    }

    public function stylePage(): string
    {
        return 'buttons';
    }

    public function styleLabel(): string
    {
        return 'Buttons';
    }
	
	public function getColorFormulaKey(): ?string
	{
		return 'button';
	}
}
