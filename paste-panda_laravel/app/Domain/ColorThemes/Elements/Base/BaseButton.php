<?php

namespace App\Domain\ColorThemes\Elements\Base;

use App\Domain\Brand\CssStyleBuilder\States\ActiveCssStyle;
use App\Domain\Brand\CssStyleBuilder\States\DisabledCssStyle;
use App\Domain\Brand\CssStyleBuilder\States\FocusCssStyle;
use App\Domain\Brand\CssStyleBuilder\States\HoverCssStyle;
use App\Domain\ColorThemes\Elements\AbstractCssItem;
use App\Domain\ColorThemes\Elements\Modifiers\ButtonWithIconsExtension;
use App\Domain\ColorThemes\Elements\Modifiers\OutlinedButtonModifiers;
use App\Domain\ColorThemes\Elements\SolidButtonColorModifiers;
use App\Domain\ColorThemes\Elements\StyleableTrait;

class BaseButton extends AbstractCssItem
{
    use StyleableTrait;
    use ColorableTrait;

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
            SolidButtonColorModifiers::class,
            OutlinedButtonModifiers::class,
            ButtonWithIconsExtension::class,
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
            'base_styles' => [
                'font-weight' => '400',
                'font-family' => 'Inter',
                'text-decoration' => '',
                'text-transform' => '',
                'border-radius' => '50px',
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
}
