<?php

namespace App\Observers;

use App\Models\LookupTag;
use App\Services\ElasticService;

class LookupTagObserver
{
    /**
     * Handle the LookupTag "created" event.
     *
     * @param  \App\Models\LookupTag  $LookupTag
     * @return void
     */
    public $afterCommit = true;

    public function created(LookupTag $LookupTag)
    {
    	ElasticService::post([],'_enrich/policy/' . env('APP_ENV') . '-lookup-tags-policy/_execute');

    	\Cache::clear();
    }

    /**
     * Handle the LookupTag "updated" event.
     *
     * @param  \App\Models\LookupTag  $LookupTag
     * @return void
     */
    public function updated(LookupTag $LookupTag)
    {
        //
    }

    /**
     * Handle the LookupTag "deleted" event.
     *
     * @param  \App\Models\LookupTag  $LookupTag
     * @return void
     */
    public function deleted(LookupTag $LookupTag)
    {
        //
    }

    /**
     * Handle the LookupTag "restored" event.
     *
     * @param  \App\Models\LookupTag  $LookupTag
     * @return void
     */
    public function restored(LookupTag $LookupTag)
    {
        //
    }

    /**
     * Handle the LookupTag "force deleted" event.
     *
     * @param  \App\Models\LookupTag  $LookupTag
     * @return void
     */
    public function forceDeleted(LookupTag $LookupTag)
    {
        //
    }
}
