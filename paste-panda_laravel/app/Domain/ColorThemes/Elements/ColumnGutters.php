<?php

namespace App\Domain\ColorThemes\Elements;

class ColumnGutters extends AbstractCssItem implements IColorVariable, IStyleVariable, Styleable
{
    use StyleableTrait;

    public static $stylePage = 'components';

    public static $styleLabel = 'Column Gutters';

    public function items(): array
    {
        return [
            CssVariable::make('column_gutters'),
        ];
    }

    public function attributes(): array
    {
        return [];
    }

    public function styles(): array
    {
        return [
            'base_styles' => [],
            'mobile_styles' => [
                'gutter-width' => '16',
            ],
            'tablet_styles' => [
                'gutter-width' => '16',
            ],
            'desktop_styles' => [
                'gutter-width' => '24',
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
		return 'Column gutters';
	}
}
