<?php

namespace App\Domain\ColorThemes\Elements\Base;

use App\Domain\ColorThemes\Elements\AbstractCssItem;
use App\Domain\ColorThemes\Elements\IColorVariable;
use App\Domain\ColorThemes\Elements\IStyleVariable;
use App\Domain\ColorThemes\Elements\Styleable;
use App\Domain\ColorThemes\Elements\StyleableTrait;

class TextBase extends AbstractCssItem implements IColorVariable, IStyleVariable, Styleable, Colorable
{
    use StyleableTrait;
    use ColorableTrait;

    public function items(): array
    {
        return [];
    }

    public function attributes(): array
    {
        return [];
    }

    public static function getBaseStructure($name)
    {
        return [
            $name => '#000',
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

    public static function makeStyle(): array
    {
        $res = [];

        $cssItem = new static;

        foreach (collect($cssItem->items())->pluck('key') as $text) {
            $res[$text] = $cssItem->styles();
        }

        return $res;
    }

    public function hasFixedColorAttribute() : bool
    {
        return true;
    }

    public function getUsesAttributesAsKeys() : bool
    {
        return true;
    }

    public function stylePage(): string
    {
        return 'texts';
    }

    public function styleType(): string
    {
        return 'texts';
    }

    public function styleLabel(): string
    {
        return 'Texts';
    }

    public function getColorFormulaKey(): ?string
    {
        return null;
    }
}
