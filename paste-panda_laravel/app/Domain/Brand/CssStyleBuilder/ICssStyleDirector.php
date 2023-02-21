<?php


namespace App\Domain\Brand\CssStyleBuilder;


interface ICssStyleDirector
{
	public function make(ICssStyleBuilder $builder) : CssStyle;
}
