<?php

namespace App\Domain\ColorThemes\Elements\Base;

use App\Domain\Brand\CssStyleBuilder\States\ActiveCssStyle;
use App\Domain\Brand\CssStyleBuilder\States\DisabledCssStyle;
use App\Domain\Brand\CssStyleBuilder\States\FocusCssStyle;
use App\Domain\Brand\CssStyleBuilder\States\HoverCssStyle;
use App\Domain\ColorThemes\Elements\CssVariable;
use App\Domain\ColorThemes\Elements\IColorVariable;
use App\Domain\ColorThemes\Elements\IStyleVariable;
use App\Domain\ColorThemes\Elements\StyleableTrait;

class ButtonOutlined extends BaseButton implements IColorVariable, IStyleVariable, Colorable
{
    use StyleableTrait;
    use ColorableTrait;

    public function items(): array
    {
        return collect((new SolidButton())
            ->items())
            ->pluck('key')
            ->map(function ($key) {
                return CssVariable::make($key . '_outlined');
            })->toArray();
    }

    public function states(): array
    {
        return [
            new HoverCssStyle(['opacity' => '0.35']),
            new ActiveCssStyle(['opacity'=> '0.35']),
            new FocusCssStyle(),
            new DisabledCssStyle(['opacity' => '0.25']),
        ];
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
        return 'button_outlined';
    }

    public function usesStyleItem(): bool
    {
        return false;
    }
}
