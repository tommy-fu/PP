<?php

namespace App\Domain\Brand\CssStylesCollection\Components;

class AccordionCss
{
    public function getCssString(): string
    {
        return '
        
        .accordion {
			cursor: pointer;
			user-select: none;
        }
        
        .accordion-toggle {
 	display: none;
}

.accordion.is-active .accordion-toggle {
 	display: block;
}';
    }
}
