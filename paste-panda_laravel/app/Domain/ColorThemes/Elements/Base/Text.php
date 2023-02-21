<?php

namespace App\Domain\ColorThemes\Elements\Base;

use App\Domain\ColorThemes\Elements\IColorVariable;
use App\Domain\ColorThemes\Elements\IStyleVariable;
use App\Domain\ColorThemes\Elements\Styleable;
use App\Domain\ColorThemes\Elements\StyleableTrait;

class Text extends TextBase implements IColorVariable, IStyleVariable, Styleable, Colorable
{
    use StyleableTrait;

    public function items(): array
    {
        return [
            [
                'key' => 'mega',
                'css_variable_name' => '--mega',
                'class_names' => ['mega'],
            ],
            [
                'key' => 'h1',
                'css_variable_name' => '--h1',
                'class_names' => ['h1'],
            ],
            [
                'key' => 'h2',
                'class_names' => ['h2'],
            ],
            [
                'key' => 'h3',
                'class_names' => ['h3'],
            ],
            [
                'key' => 'h4',
                'class_names' => ['h4'],
            ],
            [
                'key' => 'h5',
                'class_names' => ['h5'],
            ],
            [
                'key' => 'h6',
                'class_names' => ['h6'],
            ],
            ['key' => 'caption_lg'],
            ['key' => 'caption_md'],
            ['key' => 'caption_sm'],
            [
                'key' => 'body_heading_xl',
                'class_names' => ['body-heading-xl'],
            ],
            [
                'key' => 'body_heading_lg',
                'class_names' => ['body-heading-xl'],
            ],
            [
                'key' => 'body_heading_md',
                'class_names' => ['body-heading', 'body-heading-md'],
            ],
            [
                'key' => 'body_heading_sm',
                'class_names' => ['body_heading_sm'],
            ],
            [
                'key' => 'body_heading_xs',
                'class_names' => ['body-heading-xs'],
            ],
            ['key' => 'fine_print_xs'],
            ['key' => 'fine_print_sm'],
            ['key' => 'fine_print_md'],
            ['key' => 'fine_print_lg'],
        ];
    }

    public function stylePage(): string
    {
        return 'texts';
    }

    public function styleType(): string
    {
        return 'texts';
    }

    public function styleLabel(): string
    {
        return 'Texts';
    }
    
    
}
