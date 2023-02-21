<?php

namespace App\Domain\Brand\Elements\Buttons;

use App\Domain\Brand\CssStyleBuilder\States\ActiveCssStyle;
use App\Domain\Brand\CssStyleBuilder\States\DisabledCssStyle;
use App\Domain\Brand\CssStyleBuilder\States\FocusCssStyle;
use App\Domain\Brand\CssStyleBuilder\States\HoverCssStyle;
use App\Domain\Brand\Elements\Buttons\Extensions\ButtonIconExtension;
use App\Domain\ColorThemes\Elements\AbstractCssItem;
use App\Domain\ColorThemes\Elements\Base\Colorable;
use App\Domain\ColorThemes\Elements\Base\ColorableTrait;
use App\Domain\ColorThemes\Elements\CssVariable;
use App\Domain\ColorThemes\Elements\Styleable;
use App\Domain\ColorThemes\Elements\StyleableTrait;

class IconButton extends AbstractCssItem implements Styleable, Colorable
{
    use StyleableTrait;
    use ColorableTrait;

    public function items(): array
    {
        return [
            CssVariable::make('button_icon'),
        ];
    }


    public function attributes(): array
    {
        return ['background', 'color', 'border-color'];
    }

    public function states(): array
    {
        return [
            new HoverCssStyle(['opacity' => '0.75']),
            new ActiveCssStyle(['opacity'=> '0.75']),
            new FocusCssStyle(),
            new DisabledCssStyle(['opacity' => '0.25']),
        ];
    }

    public function modifiers(): array
    {
        return [
            ButtonIconExtension::class,
        ];
    }

    public function baseStyles(): array
    {
        return [
            'cursor' => 'pointer',
            'border-style' => 'solid',
            'white-space' => 'nowrap',
            'display' => 'flex',
            'justify-content' => 'center',
            'align-items' => 'center',
        ];
    }

    public function styles(): array
    {
        return [
            'base_styles' => [],
            'mobile_styles' => [],
            'tablet_styles' => [],
            'desktop_styles' => [],
        ];
    }

    public function getColorFormulaKey(): ?string
    {
        return 'button_icon';
    }

    public function stylePage(): string
    {
        return 'buttons';
    }

    public function styleLabel(): string
    {
        return 'Button Icons';
    }
}
