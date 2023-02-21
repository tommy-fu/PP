<?php

namespace App\Domain\ColorThemes\Elements;

class CardBody extends AbstractCssItem implements IStyleVariable, Styleable
{
    use StyleableTrait;

    public function items(): array
    {
        return [
        	CssVariable::make('card_body_sm'),
        	CssVariable::make('card_body_md'),
        	CssVariable::make('card_body_lg'),
        ];
    }

    public function attributes() : array
    {
        return [];
    }

    public function styles(): array
    {
        return [
            'base_styles' => [
            ],
            'mobile_styles' => [
                'padding' => '24px',
            ],
            'tablet_styles' => [
                'padding' => '24px',
            ],
            'desktop_styles' => [
                'padding' => '24px',
            ],
        ];
    }

    public function stylePage(): string
    {
        return 'card';
    }

    public function styleLabel(): string
    {
        return 'Card body';
    }
}
