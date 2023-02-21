<?php

namespace App\Domain\Brand\CssStyleBuilder;

class ModifierCssStyleDirector implements ICssStyleDirector
{
    public function make(ICssStyleBuilder $builder) : CssStyle
    {
	    $builder->reset();
	    $builder->removeAttributes();
	    $builder->setBaseVariables();
//	    $builder->setBrandVariables();
	    $builder->addColors();
	    $builder->addSubElements();
	
	    return $builder->getCssStyle();
    }
}
