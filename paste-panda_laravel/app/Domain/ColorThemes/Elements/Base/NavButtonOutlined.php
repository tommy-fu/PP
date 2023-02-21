<?php

namespace App\Domain\ColorThemes\Elements\Base;

use App\Domain\ColorThemes\Elements\CssVariable;
use App\Domain\ColorThemes\Elements\IColorVariable;
use App\Domain\ColorThemes\Elements\IStyleVariable;
use App\Domain\ColorThemes\Elements\StyleableTrait;

class NavButtonOutlined extends BaseButton implements IColorVariable, IStyleVariable, Colorable
{
    use StyleableTrait;
    use ColorableTrait;

    public function items(): array
    {
        return collect((new NavButton())
            ->items())
            ->pluck('key')
            ->map(function ($key) {
                return CssVariable::make($key . '_outlined');
            })->toArray();
    }

    public function modifiers(): array
    {
        return [];
    }


    public function stylePage(): string
    {
        return 'outlined_buttons';
    }

    public function styleLabel(): string
    {
        return 'Outlined buttons';
    }

    public function getColorFormulaKey(): ?string
    {
        return 'nav_button_outlined';
    }

    public function usesStyleItem(): bool
    {
        return false;
    }
}
