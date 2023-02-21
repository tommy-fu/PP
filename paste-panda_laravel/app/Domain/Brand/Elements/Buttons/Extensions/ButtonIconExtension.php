<?php


namespace App\Domain\Brand\Elements\Buttons\Extensions;

use App\Domain\Brand\CssStyleBuilder\AbstractCssStyle;
use App\Domain\Brand\CssStyleBuilder\Composites\WrapperCssStyle;
use App\Domain\Brand\CssStyleBuilder\CssStyle;
use App\Domain\ColorThemes\Elements\ModifierInterface;

class ButtonIconExtension implements ModifierInterface
{
    public static function handle($colorVariable = null): AbstractCssStyle
    {
        $wrapper = new WrapperCssStyle();

        $cssStyle = new CssStyle('i');
        $cssStyle->setIsElement(true);

        $cssStyle->addStyle('color', 'red');

        $wrapper->addSubClass($cssStyle);

        return $wrapper;
    }
}
