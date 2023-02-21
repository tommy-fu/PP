<?php

namespace App\Domain\ColorSchemeBuilder;

use App\ColorContrast\Color;
use App\ColorContrast\ColorItemV2;
use App\Domain\Brand\BrandVariables;
use App\Domain\ColorThemes\Elements\Base;
use App\Domain\ColorThemes\Elements\Base\Colorable;
use App\SchemeColorFormula;
use Illuminate\Support\Collection;

class SchemeColorsCollection
{
    private $schemeFormula;

    private $hex;

    private string $prefix;

    public function __construct($schemeFormula, $hex, ColorSchemePrefix $prefix)
    {
        $this->schemeFormula = array_intersect_key($schemeFormula->colors, SchemeColorFormula::generateColorVariables()) + SchemeColorFormula::generateColorVariables();
        $this->hex = $hex;
        $this->prefix = $prefix->getPrefix();
    }

    public function getVariables()
    {
        return collect(BrandVariables::$styleVariables)
//			->filter(function ($variable) {
//				return $variable != Base::class;
//			})
            ->filter(function ($variable) {
                return is_subclass_of($variable, Colorable::class);
            })
            ->flatMap(function ($cssItem) {
                $elements = new Collection();

                $cssItem = new $cssItem();

                $items = $cssItem->items();
                if ($cssItem->getUsesAttributesAsKeys()) {
                    if (get_class($cssItem) == Base::class) {
                        $baseVariables = ['background', 'primary', 'secondary', 'tertiary', 'quaternary', 'overlay_solid'];

                        $items = collect($items)
                            ->filter(function ($item) use ($baseVariables) {
                                return !in_array($item['key'], $baseVariables);
                            })->toArray();
                    }

                    collect($items)->pluck('key')->map(function ($key) use ($elements) {
                        $color = $this->applyColorFormula($key);

                        $elements->add([$this->prefix . $key => $color]);
                    });
                } else {
                    $formulaKey = $cssItem->getColorFormulaKey();

                    foreach ($cssItem->attributes() as $cssProperty) {
                        foreach ($items as $item) {
                            $color = $this->applyColorFormula($formulaKey . '-' . $cssProperty);
                            $elements->add([$this->prefix . $item['key'] . '-' . $cssProperty => $color]);

                            foreach ($cssItem->states() as $state) {
                                $color = $this->applyColorFormula($formulaKey . '_' . $state->getName() . '-' . $cssProperty);
                                $elements->add([$this->prefix . $item['key'] . '_' . $state->getName() . '-' . $cssProperty => $color]);
                            }
                        }
                    }
                }

                return $elements->toArray();
            })
            ->mapWithKeys(function ($a) {
                return $a;
            });
    }

    /**
     * @param $formulaKey
     * @param $cssProperty
     * @return ColorItemV2
     */
    protected function applyColorFormula($formulaKey): string
    {
//    	dd($this->schemeFormula);
        $formulaColor = $this->schemeFormula[$formulaKey];

        if (!empty($formulaColor['fixed_value'])) {
            return $formulaColor['fixed_value'];
        }
        $color = new ColorItemV2($this->hex);

        if (isset($formulaColor['fixed_saturation'])) {
            $color->setSaturation($formulaColor['fixed_saturation']);
        }

        if (isset($formulaColor['fixed_brightness'])) {
            $color->setBrightness($formulaColor['fixed_brightness']);
        }

        if (isset($formulaColor['altered_brightness'])) {
            $color->alterBrightness($formulaColor['altered_brightness']);
        }

        if (isset($formulaColor['altered_saturation'])) {
            $color->alterSaturation($formulaColor['altered_saturation']);
        }

        if (isset($formulaColor['opacity'])) {
            return $color->asRgba($formulaColor['opacity']);
        }

        return $color->toFullHex();
    }

    /**
     * @param $formulaKey
     * @param ColorItemV2 $color
     * @return ColorItemV2
     */
    protected function addFallbacksIfContrastIsBad($formulaKey, ColorItemV2 $color): ColorItemV2
    {
        if (in_array($formulaKey, $this->fallbackKeys)) {
            //			dd($formulaKey);
            $whiteLuminosity = (new Color(str_replace('#', '', $color->toHex())))->getLuminance(new Color('ffffff'));
            $blackLuminosity = (new Color(str_replace('#', '', $color->toHex())))->getLuminance(new Color('000000'));

            if ($whiteLuminosity >= 2 || $whiteLuminosity >= $blackLuminosity) {
                return new ColorItemV2('FFFFFF');
            }

            return new ColorItemV2('000000');
        }

        return $color;
    }
}
