<?php

namespace App\Domain\ColorThemes\Elements\Base;

trait ColorableTrait
{
    public function getColorKeys($prefix = null): array
    {
        $res = [];

        $prefix = $prefix ? $prefix . '_' : '';

        $cssItem = new static;

        if ($cssItem->hasFixedColorAttribute()) {
            foreach (collect($cssItem->items())->pluck('key') as $key) {
                $res[$key][] = [
                    'key' => $prefix .$key,
                    'property' => $key,
                ];
            }

            return [
                'label' => $cssItem->styleLabel(),
                'items' => $res,
                'type' => 'flat',
            ];
        }

        foreach ($cssItem->items() as $item) {
            foreach ($cssItem->attributes() as $attribute) {
                if (count($cssItem->states()) > 0) {
                    $res[$item['key']]['states']['default'][] = [
                        'key' => $prefix . $item['key'] . '-' . $attribute,
                        'property' => $attribute,
                    ];

                    foreach ($cssItem->states() as $state) {
                        $res[$item['key']]['states'][$state->getName()][] = [
                            'key' => $prefix . $item['key'] . '_' . $state->getName() . '-' . $attribute,
                            'property' => $attribute,
                        ];
                    }
                } else {
                    $res[$item['key']][] = [
                        'key' => $prefix . $item['key'] . '-' . $attribute,
                        'property' => $attribute,
                    ];
                }
            }
        }

        return [
            'label' => $cssItem->styleLabel(),
            'items' => $res,
        ];
    }

    public function getFormulaItem(): array
    {
        $res = [];

        $cssItem = new static;

        $item = $cssItem->getColorFormulaKey();

        if ($cssItem->hasFixedColorAttribute()) {
            foreach (collect($cssItem->items())->pluck('key') as $key) {
                $res[] = [
                    'key' => $key,
                    'property' => $key,
                ];
            }

            return [
                'label' => $cssItem->styleLabel(),
                'items' => $res,
                'type' => 'flat',
            ];
        }

        foreach ($cssItem->attributes() as $attribute) {
            if (count($cssItem->states()) > 0) {
                $res[$item]['states']['default'][] = [
                    'key' => $item . '-' . $attribute,
                    'property' => $attribute,
                ];

                foreach ($cssItem->states() as $state) {
                    $res[$item]['states'][$state->getName()][] = [
                        'key' => $item . '_' . $state->getName() . '-' . $attribute,
                        'property' => $attribute,
                    ];
                }
            } else {
                $res[$item] = [
                    'key' => $item . '-' . $attribute,
                    'property' => $attribute,
                ];
            }
        }

        return [
            'label' => $cssItem->styleLabel(),
            'items' => $res,
        ];
    }

    public static function getFormulaKeys(): array
    {
        $res = [];

        $cssItem = new static;

        if ($cssItem->hasFixedColorAttribute()) {
            return collect($cssItem->items())->pluck('key')->toArray();
        }

        $item = $cssItem->getColorFormulaKey();

        foreach ($cssItem->attributes() as $attribute) {
            $res[] = $item . '-' . $attribute;
        }

        foreach ($cssItem->states() as $state) {
            foreach ($cssItem->attributes() as $attribute) {
                $res[] = $item . '_' . $state->getName() . '-' . $attribute;
            }
        }

        return $res;
    }

    public function getUsesAttributesAsKeys(): bool
    {
        return false;
    }

    public static function isBase(): bool
    {
        return false;
    }
}
