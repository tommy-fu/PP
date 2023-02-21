<?php

namespace App\Providers;

use App\Repositories\ITagRepository;
use App\Repositories\TagsRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
//	    $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
	    $this->app->bind(ITagRepository::class, TagsRepository::class);
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
