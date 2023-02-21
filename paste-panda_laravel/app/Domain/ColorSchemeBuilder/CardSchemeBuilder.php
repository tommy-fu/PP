<?php

namespace App\Domain\ColorSchemeBuilder;

use App\SchemeColorFormula;

class CardSchemeBuilder extends AbstractSchemeBuilder
{
    public static string $prefix = 'card';

    public function setBaseColors(): self
    {
        $this->setSchemeColor('card_background', $this->getBackground());
        
        return $this;
    }
	
	public function getColorFormulaType() : int
	{
		return SchemeColorFormula::CARD_TYPE;
	}
}
