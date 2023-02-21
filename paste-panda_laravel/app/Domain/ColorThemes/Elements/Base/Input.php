<?php

namespace App\Domain\ColorThemes\Elements\Base;

use App\Domain\Brand\CssStyleBuilder\States\ActiveCssStyle;
use App\Domain\Brand\CssStyleBuilder\States\DisabledCssStyle;
use App\Domain\Brand\CssStyleBuilder\States\FocusCssStyle;
use App\Domain\Brand\CssStyleBuilder\States\HoverCssStyle;
use App\Domain\Brand\CssStyleBuilder\States\PlaceholderCssStyle;
use App\Domain\ColorThemes\Elements\AbstractCssItem;
use App\Domain\ColorThemes\Elements\CssVariable;
use App\Domain\ColorThemes\Elements\IColorVariable;
use App\Domain\ColorThemes\Elements\IStyleVariable;
use App\Domain\ColorThemes\Elements\Styleable;
use App\Domain\ColorThemes\Elements\StyleableTrait;

class Input extends AbstractCssItem implements IColorVariable, IStyleVariable, Styleable, Colorable
{
    use ColorableTrait;
    use StyleableTrait;

    public function items(): array
    {
        return [
            CssVariable::make('input_lg'),
            CssVariable::make('input_md'),
            CssVariable::make('input_sm'),
        ];
    }

    public function styles(): array
    {
        return [
            'base_styles' => [
                'font-weight' => '400',
                'font-family' => 'Inter',
                'text-decoration' => '',
                'text-transform' => '',
                'border-radius' => '50px',
                'inset-box-shadow' => '',
                'box-shadow' => '',
                'border-width' => '',
            ],
            'mobile_styles' => [
                'font-size' => '18px',
                'padding' => '14px 40px',
                'line-height' => '',
                'letter-spacing' => '',
            ],
            'tablet_styles' => [
                'font-size' => '18px',
                'padding' => '14px 40px',
                'line-height' => '',
                'letter-spacing' => '',
            ],
            'desktop_styles' => [
                'font-size' => '18px',
                'padding' => '14px 40px',
                'line-height' => '',
                'letter-spacing' => '',
            ],
        ];
    }

    public function states(): array
    {
        return [
            new ActiveCssStyle,
            new HoverCssStyle,
            new FocusCssStyle,
            new DisabledCssStyle,
        ];
    }
	
	public function baseStyles(): array
	{
		return [
			'width' => '100%',
			'outline' => 'none',
			'border-style' => 'solid',
		];
	}
	

    public function modifiers(): array
    {
        return [
            PlaceholderCssStyle::class,
        ];
    }

    public function attributes(): array
    {
        return ['background', 'color', 'border-color', 'placeholder'];
    }

    public function stylePage(): string
    {
        return 'input';
    }

    public function styleType(): string
    {
        return 'input';
    }

    public function styleLabel(): string
    {
        return 'Inputs';
    }

    public function getColorFormulaKey(): ?string
    {
        return 'input';
    }
}
