<?php

namespace App\Domain\ColorThemes\Elements;

class BorderRadius extends AbstractCssItem implements IColorVariable, IStyleVariable, Styleable
{
    use StyleableTrait;

    public static $stylePage = 'components';

    public static $styleLabel = 'Border Radius';

    public function items(): array
    {
        return [
            [
                'key' => 'border_radius_xl',
                'class_name' => 'has-border-radius-xl',
            ],
            [
                'key' => 'border_radius_lg',
                'class_name' => 'has-border-radius-lg',
            ],
            [
                'key' => 'border_radius_md',
                'class_name' => 'has-border-radius-md',
            ],
            [
                'key' => 'border_radius_sm',
                'class_name' => 'has-border-radius-sm',
            ],
            [
                'key' => 'border_radius_xs',
                'class_name' => 'has-border-radius-xs',
            ],
        ];
    }

    public function styles(): array
    {
        return [
            'base_styles' => [],
            'mobile_styles' => [
                'border-radius' => '12px',
            ],
            'tablet_styles' => [
                'border-radius' => '12px',
            ],
            'desktop_styles' => [
                'border-radius' => '12px',
            ],
        ];
    }
	
	public function stylePage(): string
	{
		return 'components';
	}
	
	public function styleType(): string
	{
		// TODO: Implement styleType() method.
	}
	
	public function styleLabel(): string
	{
		return 'Border radius';
	}
}
