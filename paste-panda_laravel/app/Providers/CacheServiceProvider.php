<?php

namespace App\Providers;

use App\Domain\Sections\Avatar;
use Illuminate\Support\ServiceProvider;

class CacheServiceProvider extends ServiceProvider
{
    // Add models to this array to loop through
    private $cacheableModels = [
        Avatar::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
	    foreach($this->cacheableModels as $cacheableModel)
	    {
		    $cacheableModel::saved(function($model) {
			    $this->fireEvent($model);
		    });
		
		    $cacheableModel::deleted(function($model) {
			    $this->fireEvent($model);
		    });
	    }
    }
	
	/**
	 * Fire the clear model cache event
	 *
	 * @param $model
	 */
	private function fireEvent( $model )
	{
//		event( new ClearModelCache( $model ) );
	}
}
