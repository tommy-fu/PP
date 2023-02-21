<?php

namespace App\Providers;

use App\Domain\Sections\HtmlSections\Avatars;
use App\Domain\Sections\HtmlSections\UnsplashImages;
use Illuminate\Support\ServiceProvider;

class UnsplashImageServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('unsplash-images', function () {
            return new UnsplashImages();
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
