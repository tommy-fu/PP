<?php


namespace App\Domain\Brand\BrandBuilder;

use App\Domain\Brand\BrandBuilder\Creators\BaseElementsCreator;
use App\Domain\Brand\CssStyleBuilder\CssStyle;
use App\Domain\Brand\CssStyleBuilder\ResponsiveCssStyleDirector;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class WrapperCssStyleElements implements ICssStyleCollection
{
    private $wrapperStyles = [
        'card' => 'card',
        'overlay' => 'has-overlay-solid',
    ];

    public function getCollection(): Collection
    {
        $brandBuilderConfig = (new BrandBuilderConfig())
            ->setDirector(new ResponsiveCssStyleDirector())
            ->setScheme(Auth::user()->colorScheme);

        return collect($this->wrapperStyles)
            ->map(function ($value, $key) use ($brandBuilderConfig) {
                $brandBuilderConfig->setPrefix($key);

                return $this->generateWrapperStyle($brandBuilderConfig, $value);
            });
    }

    public function generateWrapperStyle($brandBuilderConfig, $overflowClass): CssStyle
    {
        return (new CssStyle($overflowClass))
            ->addSubClass(BaseElementsCreator::make($brandBuilderConfig));
    }
}
