<?php

namespace App\Domain\Users\Actions;

use Illuminate\Support\Facades\Auth;

class SetUserBrandId
{
    public function execute($brandId)
    {
	    Auth::user()->update([
		    'brand_id' => $brandId,
	    ]);
    }
}
