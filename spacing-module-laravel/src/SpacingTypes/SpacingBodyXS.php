<?php

namespace Kitspring\SpacingModule\SpacingTypes;

class SpacingBodyXS extends AbstractSpacing implements SpacingInterface
{

	public function mobile(){
		return 16;
	}

	public function landscape(){
		return null;
	}
	
	public function tablet(){
		return null;
	}

	public function desktop(){
		return null;
	}

    public function alwaysOverride()
    {
        return true;
    }
	
}
