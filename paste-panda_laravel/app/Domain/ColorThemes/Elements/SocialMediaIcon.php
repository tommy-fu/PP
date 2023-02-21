<?php

namespace App\Domain\ColorThemes\Elements;

use App\Domain\Brand\CssStyleBuilder\States\ActiveCssStyle;
use App\Domain\Brand\CssStyleBuilder\States\DisabledCssStyle;
use App\Domain\Brand\CssStyleBuilder\States\FocusCssStyle;
use App\Domain\Brand\CssStyleBuilder\States\HoverCssStyle;
use App\Domain\ColorThemes\Elements\Base\Colorable;
use App\Domain\ColorThemes\Elements\Base\ColorableTrait;

class SocialMediaIcon extends AbstractCssItem implements IColorVariable, IStyleVariable, Colorable, Styleable
{
    use ColorableTrait;
    use StyleableTrait;

    public function items(): array
    {
        return [
            [
                'key' => 'social_media_icon',
            ],
        ];
    }

    public function attributes(): array
    {
        return ['background', 'color', 'border-color'];
    }

    public function styles(): array
    {
        return [
            'base_styles' => [
                'border-width' => '1px',
            ],
            'mobile_styles' => [],
            'tablet_styles' => [],
            'desktop_styles' => [],
        ];
    }

    public function baseStyles(): array
    {
        return [
            'display' => 'flex',
            'justify-content' => 'between',
            'align-items' => 'center',
            'width' => '32px',
            'height' => '32px',
            'border-radius' => '2px',
	        'cursor' => 'pointer'
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

    public function stylePage(): string
    {
        return 'icons';
    }

    public function styleLabel(): string
    {
        return 'Social media icons';
    }

    public function getColorFormulaKey(): ?string
    {
        return 'social_media_icon';
    }
}
