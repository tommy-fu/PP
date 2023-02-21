<?php

namespace App\Domain\Brand\BrandBuilder\Modifiers;

use App\Domain\Brand\BrandBuilder\BrandBuilderConfig;
use App\Domain\Brand\CssStyleBuilder\Composites\SameLevelCssStyle;
use App\Domain\ColorThemes\Colors;
use App\Domain\ColorThemes\Elements\Backgrounds\Background;
use App\Domain\ColorThemes\Elements\Modifiers\TwoWayBackgroundGradient;

class BackgroundModifiers
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
                $cssStyle = Background::make('has-background-' . $key, Colors::make($modifier) . ' !important');

                if (isset($this->modifiers[$key])) {
                    $gradientColor = Colors::make($key);
                    if ($gradientColor) {
                        $sameLvlCssStyle = new SameLevelCssStyle();

                        $gradientColor = TwoWayBackgroundGradient::make('has-background-gradient', $gradientColor);

                        $sameLvlCssStyle->addSubClass($gradientColor);

                        $cssStyle->addSubClass($sameLvlCssStyle);
                    }
                }

                return $cssStyle;
            });
    }
}
