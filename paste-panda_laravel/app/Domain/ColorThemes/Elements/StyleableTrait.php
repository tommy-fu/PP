<?php

namespace App\Domain\ColorThemes\Elements;

trait StyleableTrait
{
    public static function getStyleKeys()
    {
        $res = [];

        $cssItem = new static;

        foreach ($cssItem->items() as $item) {
            if (count($cssItem->states()) > 0) {
                $res[$item['key']]['states']['default'] = $item['key'];

                foreach ($cssItem->states() as $state) {
                    $res[$item['key']]['states'][$state->getName()] = $item['key'] . '_' . $state->getName();
                }
            } else {
                $res[$item['key']] = $item['key'];
            }
        }

        return [
            'label' => $cssItem->styleLabel(),
            'items' => $res,
        ];
    }
}
