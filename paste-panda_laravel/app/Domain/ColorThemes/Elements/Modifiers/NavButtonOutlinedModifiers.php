<?php

namespace App\Domain\ColorThemes\Elements\Modifiers;

use App\Domain\Brand\CssStyleBuilder\AbstractCssStyle;
use App\Domain\Brand\CssStyleBuilder\Composites\SameLevelCssStyle;
use App\Domain\Brand\CssStyleBuilder\CssStyle;
use App\Domain\Brand\CssStyleBuilder\ModifierCssStyleDirector;
use App\Domain\Brand\CssStyleBuilder\States\ActiveCssStyle;
use App\Domain\Brand\CssStyleBuilder\States\HoverCssStyle;
use App\Domain\ColorSchemeBuilder\ContrastChecker;
use App\Domain\ColorThemes\Colors;
use App\Domain\ColorThemes\Elements\Base\ButtonOutlined;
use App\Domain\ColorThemes\Elements\ColorModifiers;
use App\Domain\ColorThemes\Elements\ModifierInterface;

class NavButtonOutlinedModifiers implements ModifierInterface
{
    public static $modifiers = [
        'primary',
        'secondary',
        'tertiary',
        'quaternary',
    ];

    public static function handle($colorVariable = null): AbstractCssStyle
    {
        $sameLevelCssStyle = new SameLevelCssStyle();

        $builder = ButtonOutlined::getMasterBuilder('is-outlined', 'nav_button_outlined', 'nav_button_outlined');

        $director = new ModifierCssStyleDirector();

        $modifierCssStyle =  $director->make($builder);

        ColorModifiers::getColors()
            ->each(function ($modifier) use ($modifierCssStyle) {
                $cssStyle = CssStyle::make('is-' . $modifier)
                    ->addStyle('background', 'transparent !important')
                    ->addStyle('color', ContrastChecker::getBestContrast(Colors::make($modifier), Colors::make('h1'), 'ffffff') . ' !important')
                    ->addStyle('border-color', Colors::make($modifier) . ' !important');

                $cssStyle->addAdditionalStyles([
                    (new HoverCssStyle())->cssStyle()
                        ->addStyle('opacity', '0.75 !important')
                        ->addStyle('color', '#' . ContrastChecker::getBestContrast(Colors::make($modifier), Colors::make('h1'), 'ffffff') . ' !important')
                        ->addStyle('background', Colors::make($modifier) . ' !important'),
                    (new ActiveCssStyle())->cssStyle()->addStyle('opacity', '0.75 !important'),
                ]);

                $modifierCssStyle->addSubClass($cssStyle);
            });

        $sameLevelCssStyle->addSubClass($modifierCssStyle);

        return $sameLevelCssStyle;
    }
}
