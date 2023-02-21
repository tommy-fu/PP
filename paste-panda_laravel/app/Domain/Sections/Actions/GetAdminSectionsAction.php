<?php

namespace App\Domain\Sections\Actions;

use App\CssModule;
use App\Domain\ColorThemes\Colors;
use App\Domain\Sections\Models\Section;
use App\JavaScriptModule;
use App\SectionFragment;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class GetAdminSectionsAction
{
    public function execute($data = [])
    {
        Auth::user()->brand->addBrandToSingleton();

        CssModule::initializeSingleton();
        JavaScriptModule::initializeSingleton();
        SectionFragment::initializeSingleton();

        Colors::setScheme(Auth::user()->colorScheme);
        
//	    $searchTags = [];
//
//	    if (Request()->search) {
//		    foreach (explode(" ", Request()->search) as $tag) {
//			    $searchTags[] = [
//				    'match_phrase' => [
//					    'tags.tagname.keyword' => $tag
//				    ]
//			    ];
//		    }
//	    }
//
//	    $searchQuery = [
//		    'query' => [
//			    'bool' => [
//				    'should' => $searchTags
////					'minimum_should_match' => '80%'
//			    ],
//		    ],
//	    ];
//
//	    if(Request()->category){
//		    $searchQuery['post_filter'] = [
//			    'term' => ['section_category' => Request()->category]
//		    ];
//	    }
//
//	    $size = 3;
//
//	    $searchQuery = [
//		    'from' => $size * ((int)Request()->page - 1),
//		    'size' => $size,
//	    ];
//
//
//	    $results = Section::searchRaw($searchQuery);
//
//	    $sections = new Collection();
//
//	    foreach ($results['hits']['hits'] as $hit) {
//		    $section = new Section($hit['_source']);
//		    $section->id = $hit['_id'];
//		    $sections->add($section);
//	    }
	
	    $sections = Section::orderBy('updated_at', 'desc')
		    ->where('beta_section', 1)
		    ->when(Request()->category, function($q){
			    $q->whereHas('section_category', function($query){
				    return $query->whereSlug(Request()->category);
			    });
		    })
		    ->with(['javaScriptModules', 'cssModules', 'dependencies'])
		    ->paginate(3);
	    
        $sections->each(function ($section) {
            $section->rendered_html = $section->html_code->getRenderedHtml();
            $section->preview_html = $section->html_code->getRenderedHtml();
            $section->html = $section->html_code->getRenderedHtml();

            $customCss = $section->css ?? '';

            foreach ($section->cssModules as $css_module) {
                $customCss .= $css_module->code;
            }

            $section->css_code = $customCss;
            
            $section->javascript_code = $section->js->code();
	        
            $dependencies = $section->dependencies;

            $cssDependencies = $dependencies->filter(function ($dependency) {
                return $dependency->type == 1;
            })->pluck('url');

            $jsDependencies = $dependencies->filter(function ($dependency) {
                return $dependency->type == 2;
            })->pluck('url');

            $section->css_dependencies = $cssDependencies->map(function ($dependency) {
                return '<link rel="stylesheet" href="' . $dependency . '"/>';
            });

            $section->js_dependencies = $jsDependencies->map(function ($dependency) {
                return '<script type="text/javascript" src="' . $dependency . '"></script>';
            });
        });
        
        return $sections;
	    
	    return new Paginator($sections, $sections->count(), Request()->page);
    }
}
