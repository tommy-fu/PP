<?php

namespace App\Domain\ColorThemes\Elements;

use App\Domain\Brand\CssStyleBuilder\CssStyleBuilder;
use App\Domain\Brand\CssStyleBuilder\ICssStyleBuilder;
use App\Domain\Brand\Models\Brand;

abstract class AbstractCssItem
{
    public static function getBaseStructure($name)
    {
        $res = [];

        $cssItem = new static();

        foreach ($cssItem->attributes() as $attribute) {
            $res[$name . '-' . $attribute] = '#000';
        }

        foreach ($cssItem->states() as $state) {
            $item = $name . '_' . (new $state)->getName();

            foreach ($cssItem->attributes() as $attribute) {
                $res[$item . '-' . $attribute] = '#000';
            }
        }

        return $res;
    }

    public static function makeStyle(): array
    {
        $res = [];

        $cssItem = new static();

        foreach ($cssItem->items() as $item) {
            $key = $item['key'];

            $res[$key] = array_merge($cssItem->styles());

            foreach ($cssItem->states() as $state) {
                $res[$key . '_' . (new $state)->getName()] = array_merge($cssItem->styles());
            }
        }

        return $res;
    }

    //Todo: Get rid of this function
    public static function makeColorVariables($name = null)
    {
        $cssItem = new static();

        return collect($cssItem->items())
            ->flatMap(function ($item) use ($name) {
                $key = $item['key'];

                if ($name) {
                    $cardName = $name . '_';

                    return static::getBaseStructure($cardName . $key);
                }

                return static::getBaseStructure($key);
            });
    }

    //Todo: Check if this is necessary
    public static function getKeys()
    {
        $res = [];

        $cssItem = new static();

        foreach ($cssItem->items() as $item) {
            foreach ($cssItem->attributes() as $attribute) {
                $res[] = $item['key'] . '-' . $attribute;
            }

            foreach ($cssItem->states() as $state) {
                foreach ($cssItem->attributes() as $attribute) {
                    $res[] = $item['key'] . '_' . $state::$name . '-' . $attribute;
                }
            }
        }

        return $res;
    }

    //	abstract public static function styleBase(): array;

    public static function getAttributes(): array
    {
        return static::$attributes;
    }

    public function preferredVariables(): array
    {
        return [];
    }

    public static function getKeysByItem($item)
    {
        $cssItem = new static();

        $res = [];

        foreach ($cssItem->attributes() as $attribute) {
            $res[] = $item . '-' . $attribute;
        }

        foreach ($cssItem->states() as $state) {
            foreach ($cssItem->attributes() as $attribute) {
                $res[] = $item . '_' . $state::$name . '-' . $attribute;
            }
        }

        return $res;
    }

    public function items(): array
    {
        return [];
    }

    public function states(): array
    {
        return [];
    }

    public function modifiers(): array
    {
        return [];
    }

    public function attributes(): array
    {
        return [];
    }

    public function styles(): array
    {
        return [];
    }

    public function hasFixedColorAttribute(): bool
    {
        return false;
    }

    public function baseStyles(): array
    {
        return [];
    }

    public function usesStyleItem() : bool
    {
        return true;
    }

    public static function getMasterBuilder($className, $styleItem, $colorVariable): ICssStyleBuilder
    {
        $item = new static();

        $builder = new CssStyleBuilder();
        $builder->setClassName($className);
        $builder->setAttributes($item->attributes());
        $builder->setBaseStyles($item->baseStyles());
        $builder->setCssStyleStates($item->states());
        $builder->setModifiers($item->modifiers());
        if ($item->usesStyleItem()) {
            $builder->setStyleItem(Brand::getVariable($styleItem));
        }
        $builder->setPreferredVariables($item->preferredVariables());
        $builder->setColorVariable($colorVariable);
        $builder->setHasFixedColorAttribute($item->hasFixedColorAttribute());

        return $builder;
    }
}
