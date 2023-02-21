<?php


namespace App\Domain\Brand\CssStylesCollection\Reset;

use App\Domain\Brand\CssStylesCollection\Base\CssStylesCollection;
use App\Domain\ColorThemes\Colors;
use Illuminate\Support\Collection;

class BaseCss extends CssStylesCollection
{
	
	public function getCssString(): string
	{
		return "html {
    box-sizing: border-box;
}

*, *:before, *:after {
    box-sizing: inherit;
}

* {
    box-sizing: border-box;
}


h1, h2, h3, h4, h5, h6, p {
    margin-top: 0;
}

body {
	background: " . Colors::make('background') . "
}

";
	}
	
	public function getCssStyles(): Collection
	{
		return new Collection();
	}
}
