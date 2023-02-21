<?php

namespace App\Domain\Sections\Actions;

use App\Domain\Sections\Models\Avatar;
use App\Domain\Sections\Models\Section;
use Illuminate\Support\Facades\Cache;

class DuplicateSectionAction
{
    public function execute($id)
    {
	    $section = Section::findOrFail($id);
	
	    $section->beta_section = 0;
	    $section->production_ready = 0;
	    $section->production_ready = 0;
	
	    $new = $section->replicate();
	
	    //save model before you recreate relations (so it has an id)
	    $new->push();
	    
	    return $new;
    }
}
