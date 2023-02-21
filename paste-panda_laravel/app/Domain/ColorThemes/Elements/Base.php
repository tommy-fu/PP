<?php

namespace App\Domain\ColorThemes\Elements;

use App\Domain\ColorThemes\Elements\Base\Colorable;
use App\Domain\ColorThemes\Elements\Base\ColorableTrait;

class Base implements IColorVariable, Colorable, Styleable
{
    use ColorableTrait;

    public static $items = [
        'background',
        'primary',
        'secondary',
        'tertiary',
        'quaternary',
        'text',
        'border',
        'muted',
        'background_image-blend',
        'background_image-saturation',
        'image-blend',
        'image-saturation',
        'cursor_selection-text',
        'cursor_selection-background',
        'overlay_solid',
        'divider',
    ];

    public function items()
    {
        return [
        	CssVariable::make('background'),
        	CssVariable::make('primary'),
        	CssVariable::make('secondary'),
        	CssVariable::make('tertiary'),
        	CssVariable::make('quaternary'),
        	CssVariable::make('text'),
        	CssVariable::make('border'),
        	CssVariable::make('muted'),
        	CssVariable::make('background_image-blend'),
        	CssVariable::make('background_image-saturation'),
        	CssVariable::make('image-blend'),
        	CssVariable::make('image-saturation'),
        	CssVariable::make('cursor_selection-text'),
        	CssVariable::make('cursor_selection-background'),
        	CssVariable::make('overlay_solid'),
        	CssVariable::make('divider'),
        ];
    }

    public static function makeColorVariables($name = null)
    {
        return collect(self::$items)
            ->flatMap(function ($variable) use ($name) {
                if ($name) {
                    return self::getBaseStructure($name.'_'.$variable);
                }

                return self::getBaseStructure($variable);
            });
    }

    public static function getBaseStructure($name)
    {
        return [
            $name => '',
        ];
    }

    public static function getKeys()
    {
        return self::$items;
    }
    
    public static function getFormulaKeys() : array
    {
        return self::getKeys();
    }

    public function getUsesAttributesAsKeys() : bool
    {
        return true;
    }

    public static function isBase() : bool
    {
        return true;
    }

    public function hasFixedColorAttribute(): bool
    {
        return true;
    }

    public static function getStyleKeys()
    {
        // TODO: Implement getStyleKeys() method.
    }

    public function stylePage(): string
    {
        return 'base';
    }

    public function styleLabel(): string
    {
        return 'Base';
    }

    public function getColorFormulaKey(): ?string
    {
        return null;
    }
}
