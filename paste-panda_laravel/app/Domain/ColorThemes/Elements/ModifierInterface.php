<?php


namespace App\Domain\ColorThemes\Elements;


use App\Domain\Brand\CssStyleBuilder\AbstractCssStyle;

interface ModifierInterface
{
	public static function handle($colorVariable = null): AbstractCssStyle;
}
