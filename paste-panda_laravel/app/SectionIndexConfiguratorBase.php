<?php

namespace App;

use ScoutElastic\IndexConfigurator;

class SectionIndexConfiguratorBase extends IndexConfigurator
{
    public function getSettings()
    {
        return collect($this->settings)
            ->flatMap(function ($value, $key) {
                return [$key => env('APP_ENV') . '-' . $value];
            })->toArray();
    }

    public static function getFullName(): String
    {
        return (new static())->getName();
    }
}
