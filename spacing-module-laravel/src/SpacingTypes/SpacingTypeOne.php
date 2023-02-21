<?php

namespace Kitspring\SpacingModule\SpacingTypes;

class SpacingTypeOne extends AbstractSpacing implements SpacingInterface
{

	public function mobile(){
		return 24;
	}

	public function landscape(){
		return null;
	}
	
	public function tablet(){
		return null;
	}

	public function desktop(){
		return 32;
	}
	
}
