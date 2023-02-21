<?php

namespace App\Domain\Brand\Styles;

use App\Domain\Brand\BrandVariables;
use App\Domain\ColorThemes\Elements\Base\Colorable;
use App\Domain\ColorThemes\Mock\ColorSchemeMock;

class GenerateColorPageProperties
{
    public function handle($scheme, $page, $prefix)
    {
        $mock = new ColorSchemeMock();

        $scheme->colors = array_intersect_key($scheme->colors, $mock->getVariables()->toArray()) + $mock->getVariables()->toArray();

        $components = collect(BrandVariables::$styleVariables)
            ->filter(function ($component) {
                return is_subclass_of($component, Colorable::class);
            });

        if (! $page) {
            $page = $components[0]::$stylePage;
        }

        $elements = $components
            ->filter(function ($component) use ($page) {
                return (new $component)->stylePage() == $page;
            })
            ->map(function ($component) use ($prefix) {
                return (new $component)->getColorKeys($prefix);
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
}
