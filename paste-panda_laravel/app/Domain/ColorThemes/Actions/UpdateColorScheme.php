<?php

namespace App\Domain\ColorThemes\Actions;

use Illuminate\Support\Facades\Artisan;

class UpdateColorScheme
{
    public function execute($colorScheme, $data)
    {
        $colorScheme->update([
            'colors' => $data['colors'],
        ]);
	
	    Artisan::call('cache:clear');
    }
}
