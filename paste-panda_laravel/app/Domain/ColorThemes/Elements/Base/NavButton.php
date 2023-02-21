<?php

namespace App\Domain\ColorThemes\Elements\Base;

use App\Domain\ColorThemes\Elements\CssVariable;
use App\Domain\ColorThemes\Elements\IColorVariable;
use App\Domain\ColorThemes\Elements\IStyleVariable;
use App\Domain\ColorThemes\Elements\Modifiers\NavButtonOutlinedModifiers;
use App\Domain\ColorThemes\Elements\Styleable;
use App\Domain\ColorThemes\Elements\StyleableTrait;

class NavButton extends BaseButton implements IColorVariable, IStyleVariable, Styleable, Colorable
{
    use StyleableTrait;
    use ColorableTrait;

    public function items(): array
    {
        return [
            CssVariable::make('nav_button'),
        ];
    }
	
	public function modifiers(): array
	{
		return [
			NavButtonOutlinedModifiers::class
		];
	}
	
	
	public function stylePage(): string
    {
        return 'buttons';
    }

    public function styleLabel(): string
    {
        return 'Nav Buttons';
    }

    public function getColorFormulaKey(): ?string
    {
        return 'nav-button';
    }
}
