<?php

namespace App\Domain\Brand\CssStyleBuilder\States;

class DisabledCssStyle extends StatefulBase
{
	public function baseStyles(): array
	{
		return [
			'cursor' => 'not-allowed'
		];
	}
	
	public function getName(): string
	{
		return 'disabled';
	}
	
	public function pseudo(): string
	{
		return 'disabled';
	}
	
	public function className(): string
	{
		return 'is-disabled';
	}
}
