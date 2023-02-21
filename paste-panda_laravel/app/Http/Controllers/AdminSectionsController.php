<?php

namespace App\Http\Controllers;

use App\CssModule;
use App\Domain\Brand\BrandVariables;
use App\Domain\Brand\Models\Brand;
use App\Domain\ColorThemes\ColorSchemeSet;
use App\Domain\ColorThemes\Mock\ColorSchemeMock;
use App\Domain\Sections\Actions\GetCategoriesAction;
use App\Domain\Sections\Actions\GetColorThemesAction;
use App\Domain\Sections\Actions\GetSectionsAction;
use App\Domain\Sections\Models\Section;
use App\Domain\Sections\Models\SectionCategory;
use App\JavaScriptModule;
use App\SectionFragment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AdminSectionsController extends Controller
{
	/**
	 * Display a listing of the resource.  *
	 * @return \Inertia\Response
	 */
	public function index(GetColorThemesAction $getColorThemesAction, GetCategoriesAction $getCategoriesAction, GetSectionsAction $getSectionsAction)
	{
		Inertia::setRootView('app');
		
		$generatedTheme = ColorSchemeSet::with('colorSchemes')
			->where('user_id', Auth::user()->id)
			->select(['id', 'name'])
			->first();
		
		if ($generatedTheme) {
			$generatedTheme->generated_theme;
		}
		
		$tags = [];
		
		if (Request()->search) {
			foreach (explode(" ", Request()->search) as $tag) {
				$tags[] = [
					'key' => $tag,
					'value' => $tag,
				];
			}
		}
		
		return Inertia::render('CoreUI/Sections/SectionsIndex', [
			'auth' => [
				'user' => [
					'initials' => Auth::user()->getNameInitials(),
					'first_name' => Auth::user()->first_name,
					'brand_id' => Auth::user()->brand_id,
					'color_scheme_set_id' => Auth::user()->color_scheme_set_id,
					'color_scheme_id' => Auth::user()->color_scheme_id,
					'programming_language_id' => Auth::user()->programming_language_id,
					'programming_language' => Auth::user()->programming_language_id == 0 ? 'HTML' : 'React',
					'show_edit_buttons' => Auth::user()->isAdmin(),
					'show_onboarding' => Auth::user()->shouldShowOnboarding(),
					'survey_answered' => Auth::user()->survey_answered,
					'generated_theme' => $generatedTheme,
				],
			],
			'categories' => $getCategoriesAction->execute(),
			'brands' => Brand::select('id', 'name', 'description')->get(),
			'category' => Request()->category ?? '',
			'color_themes' => $getColorThemesAction->execute(),
			'search' => $tags,
			'api_url' => '/api/admin/sections'
		]);
	}


//	    $sections->each(function($section){
//	    	$dependencies = $section->getJsModuleDependencies();
//
//	    	$cssDependencies = $dependencies->filter(function ($dependency){
//	    	    return $dependency->type == 1;
//		    })->pluck('url');
//
//
//		    $jsDependencies = $dependencies->filter(function ($dependency){
//			    return $dependency->type == 2;
//		    })->pluck('url');
//
//		    $section->css_dependencies = $cssDependencies->map(function($dependency){
//		    	return '<link rel="stylesheet" href="' . $dependency . '"/>';
//		    });
//
//		    $section->js_dependencies = $jsDependencies->map(function($dependency){
//			    return '<script type="text/javascript" src="' . $dependency . '"></script>';
//		    });
//
////		    dd(Section::find(191)->javascript);
//		    $section->javascript = $section->getJavaScriptCode();
//
//	    });


//	    $brands = Brand::select('id', 'name', 'description')->get();
//
//	    return Inertia::render('CoreUI/Sections/SectionsIndex', [
//	    	'auth' => [
//			    'user' => [
//				    'initials' => Auth::user()->getNameInitials(),
//				    'first_name' => Auth::user()->first_name,
//				    'brandId' => Auth::user()->brand_id,
//				    'color_scheme_set_id' => Auth::user()->color_scheme_set_id,
//				    'color_scheme_id' => Auth::user()->color_scheme_id,
//				    'programming_language_id' => Auth::user()->programming_language_id,
//				    'show_edit_buttons' => Auth::user()->isAdmin(),
//				    'show_onboarding' => Auth::user()->shouldShowOnboarding(),
//				    'survey_answered' => Auth::user()->survey_answered,
//				    'generated_theme' => $generatedTheme,
//			    ],
//		    ],
//            'categories' => $categories,
//            'brands' => $brands,
//            'category' => Request()->category ?? '',
//            'themes' => $themes,
//            'sections' => $sections,
//		    'api_url' => '/api/admin/sections'
//        ]);
//    }
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		//
	}
	
	/**
	 * Display the specified resource.
	 *
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		//
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		//
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		//
	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		//
	}
}
