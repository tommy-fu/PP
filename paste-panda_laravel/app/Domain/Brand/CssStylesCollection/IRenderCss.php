<?php


namespace App\Domain\Brand\CssStylesCollection;


interface IRenderCss
{
	public function getCss() : string;
}
