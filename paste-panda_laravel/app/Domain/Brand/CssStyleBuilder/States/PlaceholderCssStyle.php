<?php

namespace App\Domain\Brand\CssStyleBuilder\States;

use App\Domain\Brand\CssStyleBuilder\AbstractCssStyle;
use App\Domain\Brand\CssStyleBuilder\CssStyleResult;
use App\Domain\ColorThemes\Colors;
use App\Domain\ColorThemes\Elements\ModifierInterface;

class PlaceholderCssStyle extends AbstractCssStyle implements ModifierInterface
{
    public function __construct()
    {
        parent::__construct('', []);
    }

    public function getClassCssString(CssStyleResult $cssStyleResult, $selector = ''): void
    {
        $newSelector = $selector . '::placeholder';

        $cssStyleResult->appendToCssByViewport($this->renderClass($newSelector));
    }
	
	public static function handle($colorVariable = null): AbstractCssStyle
	{
		return static::make('')
			->addStyle('color', Colors::make($colorVariable . '-' . 'placeholder'));
	}
}
