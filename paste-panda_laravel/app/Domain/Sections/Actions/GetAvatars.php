<?php

namespace App\Domain\Sections\Actions;

use App\Domain\Sections\Models\Avatar;
use Illuminate\Support\Facades\Cache;

class GetAvatars
{
    public function execute()
    {
        return Cache::rememberForever('avatars', function () {
            return Avatar::with('jobTitle')->get();
        });
    }
}
