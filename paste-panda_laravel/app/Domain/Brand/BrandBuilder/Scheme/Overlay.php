<?php

namespace App\Domain\Brand\BrandBuilder\Scheme;

use App\Domain\Brand\BrandBuilder\BrandBuilderConfig;
use App\Domain\Brand\CssStyleBuilder\Composites\ChildSelectorCssStyle;
use App\Domain\Brand\CssStyleBuilder\CssStyle;
use App\Domain\Brand\CssStyleBuilder\States\AfterCssStyle;
use App\Domain\ColorThemes\Colors;
use Illuminate\Support\Collection;

class Overlay
{
    public function handle(BrandBuilderConfig $brandBuilderConfig)
    {
        $collection = new Collection();

        $cssStyle = new CssStyle('has-overlay-solid');

        $wrapper = new ChildSelectorCssStyle();

        $asterisk = new CssStyle('*');
        $asterisk->addStyle('position', 'relative');
        $asterisk->addStyle('z-index', '100');

        $wrapper->addSubClass($asterisk);

        $cssStyle->addSubClass($wrapper);

        $collection->add($cssStyle);

        $afterCssStyle = new AfterCssStyle();

        $afterCssStyle->addStyle('background', Colors::make('overlay_solid'));
        $afterCssStyle->addStyle('content', '""');
        $afterCssStyle->addStyle('position', 'absolute');
        $afterCssStyle->addStyle('top', '0');
        $afterCssStyle->addStyle('left', '0');
        $afterCssStyle->addStyle('right', '0');
        $afterCssStyle->addStyle('bottom', '0');
        $afterCssStyle->addStyle('width', '100%');
        $afterCssStyle->addStyle('height', '100%');
        $afterCssStyle->addStyle('z-index', '1');

        $cssStyle->addSubClass($afterCssStyle);

        return $collection;
    }
}
