<?php

namespace App\Domain\Brand\CssStylesCollection;

use App\Domain\Brand\CssStyleBuilder\Composites\ChildSelectorCssStyle;
use App\Domain\Brand\CssStyleBuilder\Composites\SameLevelCssStyle;
use App\Domain\Brand\CssStyleBuilder\CssStyle;
use App\Domain\Brand\CssStyleBuilder\Viewports\DesktopCssStyle;
use App\Domain\Brand\CssStyleBuilder\Viewports\TabletCssStyle;
use App\Domain\Brand\CssStylesCollection\Base\CssStylesCollection;
use App\Domain\Brand\Models\Brand;
use Illuminate\Support\Collection;

class ColumnClasses extends CssStylesCollection
{
    public function getCssStyles(): Collection
    {
        $columnsCssStyle = (new CssStyle('columns'))
            ->addStyle('margin', '0 -' . Brand::getVariable('column_gutters')['mobile_styles']['gutter-width'] . 'px')
            ->addStyle('display', 'flex');

        $columnsCssStyle->addToViewports((new TabletCssStyle('columns'))
	        ->addStyle('margin', '0 -' . Brand::getVariable('column_gutters')['tablet_styles']['gutter-width'] . 'px')
            ->addStyle('display', 'flex'));

        $columnsCssStyle->addToViewports((new DesktopCssStyle('columns'))
	        ->addStyle('margin', '0 -' . Brand::getVariable('column_gutters')['desktop_styles']['gutter-width'] . 'px')
            ->addStyle('display', 'flex'));

        $columnCssStyle = (new CssStyle('column'))
	        ->addStyle('padding', '0 ' . intval(Brand::getVariable('column_gutters')['mobile_styles']['gutter-width']) . 'px');
        
        $columnCssStyle->addToViewports((new TabletCssStyle('column'))
	        ->addStyle('padding', '0 ' . intval(Brand::getVariable('column_gutters')['tablet_styles']['gutter-width']) . 'px'));

        $columnCssStyle->addToViewports((new DesktopCssStyle('column'))
	        ->addStyle('padding', '0 ' . intval(Brand::getVariable('column_gutters')['desktop_styles']['gutter-width']) . 'px'));

        $childSelectorStyle = (new ChildSelectorCssStyle())
            ->addSubClass($columnCssStyle);

        $columnsCssStyle->addSubClass($childSelectorStyle);

        $sameLevel = new SameLevelCssStyle();
        $sameLevel->addSubClass(CssStyle::make('is-multiline')->addStyle('flex-wrap', 'wrap'));
        $sameLevel->addSubClass(CssStyle::make('is-v-centered')
                                        ->addStyle('align-items', 'center')
                                        ->addStyle('-ms-flex-align', 'center')
                                        ->addStyle('-webkit-box-align', 'center'));

//
        $columnsCssStyle->addSubClass($sameLevel);

        $cssStyles[] = $columnsCssStyle;

        return collect($cssStyles);
    }
}
