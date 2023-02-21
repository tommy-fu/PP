<?php

namespace App\Domain\Sections\Actions;

use App\CssModule;
use App\Domain\ColorThemes\Colors;
use App\Domain\Sections\Models\HtmlConfig;
use App\Domain\Sections\Models\Section;
use App\Fragment;
use App\JavaScriptModule;
use App\SectionFragment;
use App\Services\HtmlServices;
use App\Services\HtmlToJsonConverter;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class GetFragmentsAction
{
	public function execute($data = [])
	{
		Auth::user()->brand->addBrandToSingleton();
		
		CssModule::initializeSingleton();
//        JavaScriptModule::initializeSingleton();
		
		Colors::setScheme(Auth::user()->colorScheme);
		
		
		$fragments = Fragment::orderBy('updated_at', 'desc')
//		    ->where('beta_section', 1)
//		    ->when(Request()->category, function($q){
//			    $q->whereHas('section_category', function($query){
//				    return $query->whereSlug(Request()->category);
//			    });
//		    })
//		    ->with(['javaScriptModules', 'cssModules', 'dependencies'])
//		    ->with(['javaScriptModules'])
			->paginate(3);
		
		$fragments->each(function ($fragment) {

//			try {
			app()->singleton('section', function () use ($fragment) {
				return $fragment;
			});
			
			$converter = new HtmlToJsonConverter();
			
			$htmlNode = $converter->convertHtml($fragment->html);
			$htmlService = new HtmlServices();
			
			$config = new HtmlConfig();
			$config->setIsFragment(true);
			$config->setRootClass(Fragment::class);
			
			$renderedHtml = $htmlService->getHtml(json_decode($htmlNode, true), $config);

//			if ($renderedHtml) {
			$html = HtmlServices::format($renderedHtml);
			$fragment->rendered_html = $html;
			$fragment->preview_html = $html;
			$fragment->html = $html;
			$fragment->css_dependencies = [];
			$fragment->js_dependencies = [];
//					return HtmlServices::format($renderedHtml);
//			}
//			}
			
			$customCss = $fragment->css ?? '';

//            foreach ($fragment->cssModules as $css_module) {
//                $customCss .= $css_module->code;
//            }
			
			$fragment->css_code = $customCss;
			
			$fragment->javascript_code = $fragment->javascript;
			
			$dependencies = new Collection();
//            $dependencies = $section->dependencies;
//
//			$cssDependencies = $dependencies->filter(function ($dependency) {
//				return $dependency->type == 1;
//			})->pluck('url');
//
//			$jsDependencies = $dependencies->filter(function ($dependency) {
//				return $dependency->type == 2;
//			})->pluck('url');
//
//			$fragment->css_dependencies = $cssDependencies->map(function ($dependency) {
//				return '<link rel="stylesheet" href="' . $dependency . '"/>';
//			});
//
//			$fragment->js_dependencies = $jsDependencies->map(function ($dependency) {
//				return '<script type="text/javascript" src="' . $dependency . '"></script>';
//			});
		});
		
		return $fragments;

//	    return new Paginator($fragments, $fragments->count(), Request()->page);
	}
}
