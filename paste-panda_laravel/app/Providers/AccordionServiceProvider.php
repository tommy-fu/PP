<?php

namespace App\Providers;

use App\Domain\Sections\HtmlSections\Avatars;
use App\Domain\Sections\HtmlSections\UnsplashImages;
use App\Domain\Sections\Models\AccordionManager;
use Illuminate\Support\ServiceProvider;

class AccordionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('accordion-manager', function () {
            return new AccordionManager();
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
