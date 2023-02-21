<?php

namespace App\Domain\Brand\Styles;

use App\Domain\Brand\BrandVariables;
use App\Domain\ColorThemes\Elements\Styleable;

class GenerateStylePageProperties
{
    public function handle($brand, $page)
    {
        $brand->setVariables(json_encode($this->recursive_array_intersect_key($brand->variables, BrandVariables::getBrand2()) + BrandVariables::getBrand2()));

        $components = collect(BrandVariables::$styleVariables)
            ->filter(function ($component) {
                return is_subclass_of($component, Styleable::class);
            });

        $elements = $components
            ->filter(function ($component) use ($page) {
                return (new $component)->stylePage() == $page;
            })
            ->map(function ($component) {
                return $component::getStyleKeys();
            });

        $pages = $components
            ->map(function ($component) {
                return (new $component)->stylePage();
            })
            ->unique();

        return [
            'pages' => $pages,
            'elements' => $elements,
        ];
    }

    public function recursive_array_intersect_key(array $array1, array $array2): array
    {
        $array1 = array_intersect_key($array1, $array2);

        foreach ($array1 as $key => &$value) {
            if (is_array($value) && is_array($array2[$key])) {
                $value = $this->recursive_array_intersect_key($value, $array2[$key]);
            }
        }

        return $array1;
    }
}
