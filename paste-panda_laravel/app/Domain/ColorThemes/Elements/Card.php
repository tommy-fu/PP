<?php

namespace App\Domain\ColorThemes\Elements;

use App\Domain\Brand\CssStyleBuilder\States\CardHoverable;
use App\Domain\ColorThemes\Elements\Base\Colorable;
use App\Domain\ColorThemes\Elements\Base\ColorableTrait;

class Card extends AbstractCssItem implements IStyleVariable, Styleable, Colorable
{
    use StyleableTrait;
    use ColorableTrait;

    public function attributes(): array
    {
        return ['background', 'border-color', 'box-shadow', 'box-shadow-2'];
    }

    public function baseStyles(): array
    {
        return [
            'overflow' => 'hidden',
            'border-style' => 'solid',
	        'z-index' => '0'
        ];
    }

    public function items(): array
    {
        return [
            CssVariable::make('card'),
        ];
    }

    public function styles(): array
    {
        return [
            'base_styles' => [
                'border-width' => '1px',
                'box-shadow' => '',
                'box-shadow-2' => '',
            ],
            'mobile_styles' => [
                'border-radius' => '12px',
            ],
            'tablet_styles' => [
                'border-radius' => '16px',
            ],
            'desktop_styles' => [
                'border-radius' => '24px',
            ],
        ];
    }

    public function states(): array
    {
        return [
            new CardHoverable(),
        ];
    }

    public function stylePage(): string
    {
        return 'card';
    }

    public function styleType(): string
    {
        // TODO: Implement styleType() method.
    }

    public function styleLabel(): string
    {
        return 'Card';
    }

    public function getColorPage(): string
    {
        return 'card';
    }

    public function getColorFormulaKey(): string
    {
        return 'card';
    }
}
