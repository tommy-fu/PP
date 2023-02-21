<?php

namespace App\Domain\Sections\Facades;

use App\Domain\Sections\HtmlSections\Avatars;
use Illuminate\Support\Facades\Facade;

/**
 * @see Avatars
 * @method static getAvatar(string $gender)
 */
class AvatarFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'avatars';
    }
}
