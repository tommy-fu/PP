<?php

namespace App\Domain\ColorThemes\Elements\Modifiers;

use App\Domain\Brand\CssStyleBuilder\AbstractCssStyle;
use App\Domain\Brand\CssStyleBuilder\Composites\ChildSelectorCssStyle;
use App\Domain\Brand\CssStyleBuilder\ModifierCssStyleDirector;
use App\Domain\ColorThemes\Elements\Base\BodyInlineLink;
use App\Domain\ColorThemes\Elements\ModifierInterface;

class InlineLinkModifier implements ModifierInterface
{
    public static function handle($colorVariable = null): AbstractCssStyle
    {
        $childSelectorCssStyle = new ChildSelectorCssStyle();

        $director = new ModifierCssStyleDirector();
        $builder = BodyInlineLink::getMasterBuilder('a', $colorVariable . '_inline_link', $colorVariable . '_inline_link');
        $cssStyle = $director->make($builder);
        $cssStyle->setIsElement(true);

        $childSelectorCssStyle->addSubClass($cssStyle);

        return $childSelectorCssStyle;
    }
}
