<?php


namespace App\Domain\Brand;

use App\Domain\Brand\BrandBuilder\BrandBaseCssStyles;
use App\Domain\Brand\BrandBuilder\CssStylesElement;
use App\Domain\Brand\BrandBuilder\WrapperCssStyleElements;
use Illuminate\Support\ServiceProvider;

class BrandBuilderServiceProvider extends ServiceProvider
{
    protected array $styles = [
        BrandBaseCssStyles::class,
        CssStylesElement::class,
        WrapperCssStyleElements::class,
    ];
	
	public function register()
	{
		$this->app->singleton(BrandCssStylesCollection::class, function(){
			return new BrandCssStylesCollection(collect($this->styles)
				->map(function($collection){
					return new $collection();
			}));
		});
	}
	
	
}
