<?php

namespace App\Providers;

use App\Domain\Brand\CssStylesCollection\Brand\BrandCssStyles;
use App\Domain\Brand\CssStylesCollection\ColumnClasses;
use App\Domain\Brand\CssStylesCollection\CssStyleService;
use App\Domain\Brand\CssStylesCollection\NonResponsiveHelperClasses;
use App\Domain\Brand\CssStylesCollection\ResponsiveHelperClasses;
use App\Domain\Brand\CssStylesCollection\ResponsiveUtilityClassCollection;
use App\Domain\Brand\CssStylesCollection\ResponsiveUtilityClasses\ImageClasses;
use App\Domain\Brand\CssStylesCollection\UtilityClassCollection;
use Illuminate\Support\ServiceProvider;

class CssStylesServiceProvider extends ServiceProvider
{
    protected array $collection = [
        BrandCssStyles::class,
        ResponsiveUtilityClassCollection::class,
        UtilityClassCollection::class,
        ColumnClasses::class,
        ImageClasses::class,
        ResponsiveHelperClasses::class,
        NonResponsiveHelperClasses::class,
    ];


    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(CssStyleService::class, function () {
            return new CssStyleService(collect($this->collection));
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
