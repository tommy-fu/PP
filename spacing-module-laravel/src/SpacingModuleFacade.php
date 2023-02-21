<?php

namespace Kitspring\SpacingModule;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Kitspring\SpacingModule\SpacingModule
 */
class SpacingModuleFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'spacing-module';
    }
}
