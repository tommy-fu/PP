<?php

namespace App\Domain\Brand\CssStyleBuilder;

use App\Domain\Brand\BrandBuilder\Viewports;
use App\Domain\Brand\CssStyleBuilder\Viewports\TabletCssStyle;

class CssStyleResult
{
    private $resultCss;

    public function __construct()
    {
        $this->resultCss = ['base' => ''];

        foreach (Viewports::get() as $viewport) {
            $this->resultCss[$viewport::$suffix] = '';
        }
    }

    public function appendToCssByViewport(string $css, $viewport = 'base')
    {
        $this->resultCss[$viewport] .= $css;
    }

    public function getCss(): string
    {
        $result = '';

        foreach ($this->resultCss as $key => $resultCss) {
            if ($key == 'base') {
                $result .= $resultCss;
            } else {
            	
            	$viewportStyle = Viewports::get()->first(function($viewport) use($key){
            		return $viewport::$suffix == $key;
	            });
            	
                $result .= '@media screen and (min-width:' . $viewportStyle::$deviceWidth . 'px)' . ' {' . PHP_EOL;
                $result .= $resultCss;
                $result .= '}' . PHP_EOL;
            }
        }

        return $result;
    }
}
