<?php

namespace App\Domain\ColorThemes\Elements\Base;

use App\Domain\ColorThemes\Elements\AbstractCssItem;
use App\Domain\ColorThemes\Elements\CssVariable;
use App\Domain\ColorThemes\Elements\IColorVariable;
use App\Domain\ColorThemes\Elements\IStyleVariable;
use App\Domain\ColorThemes\Elements\Modifiers\BadgeModifiers;
use App\Domain\ColorThemes\Elements\Styleable;
use App\Domain\ColorThemes\Elements\StyleableTrait;

class Badge extends AbstractCssItem implements IColorVariable, IStyleVariable, Styleable, Colorable
{
    use StyleableTrait;
    use ColorableTrait;

    public static $formulaKey = 'badge';

    public function items(): array
    {
        return [
            CssVariable::make('badge_xl'),
            CssVariable::make('badge_lg'),
            CssVariable::make('badge_md'),
            CssVariable::make('badge_sm'),
            CssVariable::make('badge_xs'),
        ];
    }

    public function attributes(): array
    {
        return ['background', 'color', 'border-color'];
    }

    public function modifiers(): array
    {
        return [
            BadgeModifiers::class,
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
                'box-shadow' => '',
                'border-width' => '0px',
                'border-style' => 'solid',
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

    public function baseStyles(): array
    {
        return [
            'display' => 'inline-block',
        ];
    }

    public static function getFormulaItem(): array
    {
        $res = [];

        $cssItem = new static;

        foreach (static::getKeysByItem('badge') as $key) {
            $res[] = [
                'key' => $key,
                'property' => $key,
            ];
        }

        return [
            'label' => $cssItem->styleLabel(),
            'items' => $res,
        ];
    }

    public function stylePage(): string
    {
        return 'badges';
    }

    public function styleLabel(): string
    {
        return 'Badges';
    }
	
	public function getColorFormulaKey(): ?string
	{
		return 'badge';
	}
}
