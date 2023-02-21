<?php

namespace Kitspring\SpacingModule\Commands;

use Illuminate\Console\Command;

class SpacingModuleCommand extends Command
{
    public $signature = 'spacing-module';

    public $description = 'My command';

    public function handle()
    {
        $this->comment('All done');
    }
}
