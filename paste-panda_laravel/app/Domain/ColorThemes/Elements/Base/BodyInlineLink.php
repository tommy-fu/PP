<?php

namespace App\Domain\ColorThemes\Elements\Base;

use App\Domain\Brand\CssStyleBuilder\States\ActiveCssStyle;
use App\Domain\Brand\CssStyleBuilder\States\DisabledCssStyle;
use App\Domain\Brand\CssStyleBuilder\States\FocusCssStyle;
use App\Domain\Brand\CssStyleBuilder\States\HoverCssStyle;
use App\Domain\Brand\CssStyleBuilder\States\StatefulBase;
use App\Domain\ColorThemes\Elements\AbstractCssItem;
use App\Domain\ColorThemes\Elements\CssVariable;
use App\Domain\ColorThemes\Elements\IColorVariable;
use App\Domain\ColorThemes\Elements\IStyleVariable;
use App\Domain\ColorThemes\Elements\Styleable;
use App\Domain\ColorThemes\Elements\StyleableTrait;

class BodyInlineLink extends AbstractCssItem implements IColorVariable, IStyleVariable, Styleable, Colorable
{
    use ColorableTrait;
    use StyleableTrait;

    public function attributes(): array
    {
        return ['color'];
    }
	
	public function items(): array
	{
		return collect((new BodyText())
			->items())
			->pluck('key')
			->map(function ($key) {
				return CssVariable::make($key . '_inline_link');
			})->toArray();
	}
	
    public function preferredVariables() : array
    {
        return [
//            'color' => 'primary',
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
            'base_styles' => [],
            'mobile_styles' => [],
            'tablet_styles' => [],
            'desktop_styles' => [],
        ];
    }

    public function baseStyles(): array
    {
        return [
            'cursor' => 'pointer',
            'text-decoration' => 'none',
        ];
    }



    public function stylePage(): string
    {
        return 'inline_links';
    }

    public function styleLabel(): string
    {
        return 'Inline links';
    }

    public function getColorFormulaKey(): ?string
    {
        return 'inline_link';
    }

    public function usesStyleItem() : bool
    {
        return false;
    }
}
