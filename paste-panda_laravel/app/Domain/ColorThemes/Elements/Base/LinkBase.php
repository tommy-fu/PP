<?php

namespace App\Domain\ColorThemes\Elements\Base;

use App\Domain\Brand\CssStyleBuilder\States\ActiveCssStyle;
use App\Domain\Brand\CssStyleBuilder\States\DisabledCssStyle;
use App\Domain\Brand\CssStyleBuilder\States\FocusCssStyle;
use App\Domain\Brand\CssStyleBuilder\States\HoverCssStyle;
use App\Domain\ColorThemes\Elements\AbstractCssItem;

class LinkBase extends AbstractCssItem
{
    public function attributes(): array
    {
        return ['color'];
    }

    public function preferredVariables() : array
    {
        return [
            'color' => 'primary',
        ];
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

    public function styles(): array
    {
        return [
            'base_styles' => [
                'font-weight' => '400',
                'font-family' => 'Inter',
                'text-decoration' => 'none',
                'text-transform' => '',
            ],
            'mobile_styles' => [
                'font-size' => '14px',
                'line-height' => '24px',
                'letter-spacing' => '-3.5%',
            ],
            'tablet_styles' => [
                'font-size' => '14px',
                'line-height' => '24px',
                'letter-spacing' => '-3.5%',
            ],
            'desktop_styles' => [
                'font-size' => '18px',
                'line-height' => '24px',
                'letter-spacing' => '-3.5%',
            ],
        ];
    }

    public function baseStyles(): array
    {
        return [
            'cursor' => 'pointer',
        ];
    }
}
