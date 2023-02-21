<?php

namespace App\Domain\ColorThemes\Mock;

use App\Domain\Brand\BrandVariables;
use App\Domain\ColorThemes\Elements\Base\Colorable;
use Illuminate\Support\Collection;

class ColorSchemeMock
{
    public function getVariables()
    {
        $prefixes = [null, 'card', 'overlay'];

        return collect($prefixes)
            ->flatMap(function ($prefix) {
                return $this->createVariable($prefix);
            });
    }

    public function createVariable($prefix): Collection
    {
        return collect(BrandVariables::$styleVariables)
            ->filter(function ($component) {
                return is_subclass_of($component, Colorable::class);
            })
            ->map(function ($component) use ($prefix) {
                return (new $component)->makeColorVariables();
            })
            ->flatMap(function ($items) use ($prefix) {
                return $items->keyBy(function ($a, $key) use ($prefix) {
                    return $prefix ? $prefix . '_' . $key : $key;
                });
            });
    }
}
