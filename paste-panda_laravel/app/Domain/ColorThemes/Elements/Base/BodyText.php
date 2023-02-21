<?php

namespace App\Domain\ColorThemes\Elements\Base;

use App\Domain\ColorThemes\Elements\IColorVariable;
use App\Domain\ColorThemes\Elements\IStyleVariable;
use App\Domain\ColorThemes\Elements\Modifiers\InlineLinkModifier;
use App\Domain\ColorThemes\Elements\Styleable;
use App\Domain\ColorThemes\Elements\StyleableTrait;

class BodyText extends TextBase implements IColorVariable, IStyleVariable, Styleable, Colorable
{
    use StyleableTrait;

    public function items(): array
    {
        return [
            [
                'key' => 'body_xl',
            ],
            [
                'key' => 'body_lg',
            ],
            [
                'key' => 'body_md',
            ],
            [
                'key' => 'body_sm',
            ],
            [
                'key' => 'body_xs',
            ],
        ];
    }

    public function modifiers(): array
    {
        return [
            InlineLinkModifier::class,
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
        return 'Body Texts';
    }
}
