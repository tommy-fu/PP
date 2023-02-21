<?php

namespace App\Domain\Brand\CssStylesCollection\ResponsiveUtilityClasses;

use App\ColorContrast\ColorItemV2;
use App\Domain\Brand\CssStyleBuilder\Composites\ChildSelectorCssStyle;
use App\Domain\Brand\CssStyleBuilder\Composites\SameLevelCssStyle;
use App\Domain\Brand\CssStyleBuilder\CssStyle;
use App\Domain\ColorThemes\Colors;

class RemixIconsCollection implements IUtilityClass
{
    //Todo: Access these from a common class
    private $modifiers = [
        'primary' => 'primary',
        'secondary' => 'secondary',
        'tertiary' => 'tertiary',
        'quaternary' => 'quaternary',
    ];

    public function getUtilityClasses()
    {
        $sizes = [16, 20, 24, 28, 32, 40, 48, 56, 64, 72, 80, 88, 96];

        $cssStyle = CssStyle::make('icon-container')
            ->addStyle('border-radius', '16px')
            ->addStyle('width', '32px')
            ->addStyle('height', '32px')
            ->addStyle('font-size', '16px')
            ->addStyle('display', 'flex')
            ->addStyle('justify-content', 'center')
            ->addStyle('align-items', 'center');

        collect($sizes)
            ->each(function ($size) use ($cssStyle) {
                $sameLevel = new SameLevelCssStyle();

                $modifierCssStyle = CssStyle::make('is-' . $size  . 'x' . $size);

                $modifierCssStyle->addStyle('width', $size. 'px !important');
                $modifierCssStyle->addStyle('min-width', $size. 'px !important');
                $modifierCssStyle->addStyle('height', $size. 'px !important');
                $modifierCssStyle->addStyle('min-height', $size. 'px !important');
                $modifierCssStyle->addStyle('font-size', $size/2 . 'px !important');

                $sameLevelCss = new SameLevelCssStyle();
                $strippedStyle = new CssStyle('is-stripped');
                $strippedStyle->addStyle('font-size', $size . 'px !important');

                $sameLevelCss->addSubClass($strippedStyle);
	
	            $modifierCssStyle->addSubClass($strippedStyle);
	            
	            $sameLevel->addSubClass($modifierCssStyle);

                $cssStyle->addSubClass($sameLevel);
            });

        collect($this->modifiers)
            ->each(function ($modifier) use ($cssStyle) {
                $sameLevel = new SameLevelCssStyle();

                $color = ColorItemV2::make(Colors::make($modifier));

                $modifierCssStyle = CssStyle::make('is-' . $modifier);

                $modifierCssStyle->addStyle('background', $color->asRgba(0.20));

                $childSelector = new ChildSelectorCssStyle();

                $color->setBrightness(60);

                $iconClass = (new CssStyle('i'))
                    ->setIsElement(true)
                    ->addStyle('color', $color->toFullHex());

                $childSelector->addSubClass($iconClass);

                $modifierCssStyle->addSubClass($childSelector);

                $sameLevel->addSubClass($modifierCssStyle);

                $cssStyle->addSubClass($sameLevel);
            });

        return collect([
            $cssStyle,
        ]);
    }
}
