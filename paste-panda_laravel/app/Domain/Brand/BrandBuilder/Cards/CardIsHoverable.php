<?php

namespace App\Domain\Brand\BrandBuilder\Cards;

use App\Domain\Brand\CssStyleBuilder\AbstractCssStyle;
use App\Domain\Brand\CssStyleBuilder\Composites\SameLevelCssStyle;
use App\Domain\Brand\CssStyleBuilder\CssStyle;
use App\Domain\Brand\CssStyleBuilder\States\HoverCssStyle;
use App\Domain\ColorThemes\Colors;
use App\Domain\ColorThemes\Elements\ModifierInterface;

class CardIsHoverable extends AbstractCssStyle
{
	public static $name = 'hover';
	public static $pseudo = 'hover';
	public static $className = 'is-hovered';
	
    public static function handle($colorVariable = null): AbstractCssStyle
    {
        $sameLvlCssStyle = new SameLevelCssStyle();

        $cssStyle = new CssStyle('is-hoverable');

        $hover = new HoverCssStyle();
        $hover->addStyle('transition', '0.2s');
        $hover->addStyle('background', Colors::make('card_hover-background'));

        $cssStyle->addAdditionalStyle($hover);

        $sameLvlCssStyle->addSubClass($cssStyle);
	
        return $sameLvlCssStyle;
    }
}
