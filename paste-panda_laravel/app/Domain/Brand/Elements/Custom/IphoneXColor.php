<?php

namespace App\Domain\Brand\Elements\Custom;

use App\Domain\ColorThemes\Elements\AbstractCssItem;
use App\Domain\ColorThemes\Elements\Base\Colorable;
use App\Domain\ColorThemes\Elements\Base\ColorableTrait;
use App\Domain\ColorThemes\Elements\CssVariable;

class IphoneXColor extends AbstractCssItem implements Colorable
{
    use ColorableTrait;

    public function items(): array
    {
        return [
            CssVariable::make('iphone_x'),
        ];
    }


    public function attributes(): array
    {
        return ['color'];
    }

    public function states(): array
    {
        return [];
    }

    public function modifiers(): array
    {
        return [];
    }


    public function getColorFormulaKey(): ?string
    {
        return 'iphone_x';
    }

    public function stylePage(): string
    {
        return 'iphone';
    }

    public function styleLabel(): string
    {
        return 'iPhone';
    }
}
