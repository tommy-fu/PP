<?php

namespace App\Domain\Brand\CssStyleBuilder;

use App\Domain\Brand\CssStyleBuilder\Viewports\DesktopCssStyle;
use App\Domain\Brand\CssStyleBuilder\Viewports\TabletCssStyle;
use App\Models\HtmlModels\ICssStyle;

class CssStyle extends AbstractCssStyle implements ICssStyle
{
    private $usesSuffix = false;

    public function getTheClassName(): string
    {
        return $this->getSelector();
    }

    public function getClassCssString(CssStyleResult $cssStyleResult, $selector = ''): void
    {
        $newSelector = $selector . $this->getTheClassName();

        $cssStyleResult->appendToCssByViewport($this->renderClass($newSelector));

        foreach ($this->getSubClasses() as $subClass) {
            $subClass->getClassCssString($cssStyleResult, $newSelector);
        }

        foreach ($this->getAdditionalStyles() as $additionalStyle) {
            $additionalStyle->getClassCssString($cssStyleResult, $newSelector);
        }
//
        if ($this->getViewPorts()->count() > 0) {
            foreach ($this->getViewPorts() as $viewPort) {
                $css = $this->getCssByViewport($selector, $viewPort);

                $cssStyleResult->appendToCssByViewport($css, $viewPort::$suffix);
            }
        }
    }

    public function getCssByViewport($selector, AbstractCssStyle $cssStyle)
    {
        $newSelector = $selector . $this->getTheClassName();

        if ($this->usesSuffix) {
            $newSelector .= '-' . $cssStyle::$suffix;
        }

        $css = '';

        if (count($cssStyle->getStyles()) > 0) {
            $css = $newSelector . ' {' . PHP_EOL;
            $css .= $cssStyle->getStyleString();
            $css .= '}' . PHP_EOL . PHP_EOL;
        }

        foreach ($cssStyle->getSubClasses() as $subClass) {
            $css .= $subClass->getClassCssString($newSelector);
        }

        foreach ($cssStyle->getAdditionalStyles() as $additionalStyle) {
            $css .= $additionalStyle->getClassCssString($newSelector);
        }

        return $css;
    }

    /**
     * @param bool $usesSuffix
     * @return CssStyle
     */
    public function setUsesSuffix(bool $usesSuffix): CssStyle
    {
        $this->usesSuffix = $usesSuffix;

        return $this;
    }
	
	public function setResponsiveValues($styleItem) : self {
		$tabletStyle = (new TabletCssStyle($this->getTheClassName()))
			->addStylesFromKeyValue($styleItem['tablet_styles']);
		
		$desktopCss = (new DesktopCssStyle($this->getTheClassName()))
			->addStylesFromKeyValue($styleItem['desktop_styles']);
		
		$this
			->addStylesFromKeyValue($styleItem['base_styles'])
			->addStylesFromKeyValue($styleItem['mobile_styles'])
			->addToViewports($tabletStyle)
			->addToViewports($desktopCss);
		
		return $this;
    }
}
