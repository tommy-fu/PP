<?php

namespace App\Domain\Brand\BrandBuilder\Cards;

use App\Domain\Brand\BrandBuilder\BrandBuilderConfig;
use App\Domain\Brand\BrandBuilder\CardBodyCssStyle;
use App\Domain\Brand\CssStyleBuilder\AbstractCssStyle;
use App\Domain\Brand\CssStyleBuilder\Composites\AbstractCompositeCssStyle;
use App\Domain\Brand\CssStyleBuilder\Composites\SameLevelCssStyle;
use App\Domain\Brand\CssStyleBuilder\Composites\WrapperCssStyle;
use App\Domain\Brand\CssStyleBuilder\CssStyle;
use App\Domain\ColorThemes\Elements\Card;
use Illuminate\Support\Collection;

class CardStyle
{
    public function handle(BrandBuilderConfig $brandBuilderConfig) : Collection
    {
        $cardCssStyle = $brandBuilderConfig->getDirector()->make(Card::getMasterBuilder('card', 'card', 'card'));
	
        $wrapperCssStyle = new WrapperCssStyle();
        $wrapperCssStyle->addSubClass(new CardBodyCssStyle('card-body', 'card_body_md'));
	
	    $cardCssStyle->addSubClass($wrapperCssStyle);
	    
        $sameLevel = new SameLevelCssStyle();
        
        $sm = new CssStyle('has-padding-sm');
	
	    $wrapperCssStyle = new WrapperCssStyle();
	    $wrapperCssStyle->addSubClass(new CardBodyCssStyle('card-body', 'card_body_sm'));
	
	    $sm->addSubClass($wrapperCssStyle);
	    
        $sameLevel->addSubClass($sm);
	
	
	    $sm = new CssStyle('has-padding-lg');
	
	    $wrapperCssStyle = new WrapperCssStyle();
	    $wrapperCssStyle->addSubClass(new CardBodyCssStyle('card-body', 'card_body_lg'));
	
	    $sm->addSubClass($wrapperCssStyle);
	
	    $sameLevel->addSubClass($sm);
	    
	    
	    $cardCssStyle->addSubClass($sameLevel);
		    
        return (new Collection())
            ->add($cardCssStyle);
    }
}
