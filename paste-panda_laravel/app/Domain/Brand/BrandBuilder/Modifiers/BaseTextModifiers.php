<?php

namespace App\Domain\Brand\BrandBuilder\Modifiers;

use App\Domain\Brand\BrandBuilder\BrandBuilderConfig;
use App\Domain\ColorThemes\Colors;
use App\Domain\ColorThemes\Elements\Modifiers\TextColor;

class BaseTextModifiers
{
    private array $modifiers = [
        'base' => 'text',
        'muted' => 'muted',
    ];

    public function handle(BrandBuilderConfig $brandBuilderConfig)
    {
    	$prefix = $brandBuilderConfig->getPrefix();
    	
        return collect($this->modifiers)
            ->map(function ($modifier, $key) use($prefix){
                return TextColor::makeWithSuffix('has-text-' . $key, Colors::make($prefix . $modifier) . ' !important');
            });
    }
}
