<?php

namespace Kitspring\SpacingModule;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Kitspring\SpacingModule\Commands\SpacingModuleCommand;

class SpacingModuleServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('spacing-module')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_spacing-module_table')
            ->hasCommand(SpacingModuleCommand::class);
    }
}
