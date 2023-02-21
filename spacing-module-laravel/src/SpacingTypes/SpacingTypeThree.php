<?php

namespace Kitspring\SpacingModule\SpacingTypes;

class SpacingTypeThree extends AbstractSpacing implements SpacingInterface
{

	public function mobile(){
		return 12;
	}

	public function landscape(){
		return null;
	}
	
	public function tablet(){
		return null;
	}

	public function desktop(){
		return 16;
	}
	
}
