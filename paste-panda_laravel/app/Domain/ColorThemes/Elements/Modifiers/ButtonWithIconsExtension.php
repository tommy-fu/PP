<?php

namespace App\Domain\ColorThemes\Elements\Modifiers;

use App\Domain\Brand\CssStyleBuilder\AbstractCssStyle;
use App\Domain\Brand\CssStyleBuilder\Composites\SameLevelCssStyle;
use App\Domain\Brand\CssStyleBuilder\Composites\WrapperCssStyle;
use App\Domain\Brand\CssStyleBuilder\CssStyle;
use App\Domain\ColorThemes\Elements\ModifierInterface;
use App\Domain\ColorThemes\Elements\Texts\FontSize;

class ButtonWithIconsExtension implements ModifierInterface
{
    public static function handle($colorVariable = null): AbstractCssStyle
    {
        $wrapperCssStyle = new WrapperCssStyle();

        $cssStyle = new CssStyle('icon:first-child:not(:last-child)');
        
	    $cssStyle->addStyle('display', 'inline-flex')
	    ->addStyle('align-items', 'center')
	    ->addStyle('justify-content', 'center')
	    ->addStyle('font-size', '1.5em')
	    ->addStyle('margin-right', '0.3em');
	    
//        $sameLevel = new SameLevelCssStyle();
//        $sameLevel->addSubClass(FontSize::make('is-sm', '1em')->addStyle('margin-right', '0.75em'));
//        $sameLevel->addSubClass(FontSize::make('is-md', '1.5em')->addStyle('margin-right', '0.5em'));
//        $sameLevel->addSubClass(FontSize::make('is-lg', '2em')->addStyle('margin-right', '0.25em'));
//
//        $cssStyle->addSubClass($sameLevel);
        
        $wrapperCssStyle->addSubClass($cssStyle);
	
	    $cssStyle = new CssStyle('icon:last-child:not(:first-child)');
	
	    $cssStyle->addStyle('display', 'inline-flex')
		    ->addStyle('align-items', 'center')
		    ->addStyle('justify-content', 'center')
		    ->addStyle('font-size', '1.5em')
		    ->addStyle('margin-left', '0.3em');
	    
	    $wrapperCssStyle->addSubClass($cssStyle);
	
	    return $wrapperCssStyle;
    }
}
