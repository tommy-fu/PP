<?php

namespace App;

use ScoutElastic\Migratable;

class SectionIndexConfigurator extends SectionIndexConfiguratorBase
{
    use Migratable;
    
    protected $name = 'sections';

    /**
     * @var array
     */
    
    protected $settings = [
        'index.default_pipeline' => 'generate-tags'
    ];
}
