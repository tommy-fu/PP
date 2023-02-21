<?php

namespace App\Providers;

use App\Domain\Brand\CssStylesCollection\Brand\BrandFonts;
use App\Domain\Brand\CssStylesCollection\Icons\IconCss;
use App\Domain\Brand\CssStylesCollection\iPhoneXCss;
use App\Domain\Brand\CssStylesCollection\PureCss;
use App\Domain\Brand\CssStylesCollection\Reset\BaseCss;
use App\Domain\Brand\CssStylesCollection\Reset\Normalizer;
use Illuminate\Support\ServiceProvider;

class PureCssServiceProvider extends ServiceProvider
{
	protected array $cssFiles = [
		Normalizer::class,
		BaseCss::class,
		BrandFonts::class,
		IconCss::class,
		iPhoneXCss::class,
	];
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(PureCss::class, function(){
        	return new PureCss(collect($this->cssFiles));
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
