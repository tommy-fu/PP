<?php

namespace App\Domain\Sections\Actions;

use App\CssModule;
use App\Domain\Brand\BrandVariables;
use App\Domain\ColorThemes\Colors;
use App\Domain\Sections\Models\Section;
use App\JavaScriptModule;
use App\SectionFragment;
use Illuminate\Support\Facades\Auth;

class GetSectionAction
{
    public function execute(Section $section)
    {
	    Auth::user()->brand->addBrandToSingleton();

	    JavaScriptModule::initializeSingleton();
	    SectionFragment::initializeSingleton();
	    CssModule::initializeSingleton();
		
		Colors::setScheme(Auth::user()->colorScheme);

	    $section->rendered_html = $section->html_code->getRenderedHtml();
	    $section->preview_html = $section->html_code->getPreviewHtml();
	    
	    return $section;
    }
}
