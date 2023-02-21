<?php

namespace App\Domain\Brand\BrandBuilder\Modifiers;

use App\ColorContrast\ColorItemV2;
use App\Domain\Brand\BrandBuilder\BrandBuilderConfig;
use App\Domain\Brand\CssStyleBuilder\Composites\AbstractCompositeCssStyle;
use App\Domain\Brand\CssStyleBuilder\Composites\SameLevelCssStyle;
use App\Domain\ColorThemes\Colors;
use App\Domain\ColorThemes\Elements\Modifiers\DerivedColor;
use App\Domain\ColorThemes\Elements\Modifiers\TextColor;
use App\Domain\ColorThemes\Elements\Modifiers\TwoWayTextGradient;

class TextModifiers
{
    private $modifiers = [
        'primary' => 'primary',
        'secondary' => 'secondary',
        'tertiary' => 'tertiary',
        'quaternary' => 'quaternary',
    ];

    public function handle(BrandBuilderConfig $brandBuilderConfig)
    {
        return collect($this->modifiers)
            ->map(function ($modifier, $key) {
                $cssStyle = TextColor::makeWithSuffix('has-text-' . $key, Colors::make($modifier) . ' !important');
	
	            $sameLvlCssStyle = new SameLevelCssStyle();
	            
	            $sameLvlCssStyle->addSubClass(TextColor::makeWithSuffix('is-derived', DerivedColor::make(Colors::make($modifier))->toFullHex() . ' !important'));
	            
                $gradientColor = Colors::make($key);
                
                if ($gradientColor) {
                

                    $gradientColor = TwoWayTextGradient::make('has-text-gradient', $gradientColor);

                    $sameLvlCssStyle->addSubClass($gradientColor);

                    $cssStyle->addSubClass($sameLvlCssStyle);
                }
                
                return $cssStyle;
            });
    }
}
