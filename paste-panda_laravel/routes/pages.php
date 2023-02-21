<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/pages/{id}', function ($id) {
	
	$page = \App\Domain\PageBuilder\Models\Page::findOrFail($id);
	
	$pageSections = PageSection::where('page_id', $page->id)
		->get();
	
	foreach ($pageSections as $pageSection) {
//		    dd($item);
		if ($pageSection->fields == null) {
//		    	dd($pageSection->section);
			$pageSection->update([
				'fields' => $pageSection->section->blade_fields
			]);
		}
	}
	
	$sections2 = $page->sections()
		->with('section_category')
		->withPivot('fields', 'id')
		->orderBy('page_sections.order_column')
		->get();
	
	
	foreach ($sections2 as $item) {
//		    $item->fields = $fields;
//		    json_decode($item->blade_fields);
//		    dd($item->pivot);
		$fields = json_decode($item->pivot->fields, true);
		$item->fields = $fields;
		$item->page_section_id = $item->pivot->id;
		
		if ($item->html) {
			
			$field_array = [];
			if (is_array($fields)) {
				$field_array = array_column($fields, 'value', 'key');
//				if($item->id == 37){
//					print_r($field_array);
//				}
			}
			
			$item->html_code = \App\Services\BladeCompiler::compileString($item->html, $field_array);
		}
	}
	
	$page->sections = $sections2;
	
	return response()->json($page, 200);
});

Route::post('pages/{id}/sections/{sectionId}', function ($id, $sectionId, Request $request) {
	
	$page = \App\Domain\PageBuilder\Models\Page::find($id);
	
	$section = \App\Domain\Sections\Models\Section::find($sectionId);
	
	$fieldData = [];
	
	if ($section->html) {
		$fields = json_decode($section->fields, true);
		if ($fields) {
			
			$field_array = array_column($fields, 'value', 'key');
			$section->html_code = \App\Services\BladeCompiler::compileString($section->html, $field_array);
		}
	}
	
	$pageSection = \App\Domain\PageBuilder\Models\PageSection::create([
		'fields' => $section->fields,
		'section_id' => $section->id,
		'page_id' => $page->id,
	]);
//	$page->sections()->create([
////		'section_id' => $section->id,
////		'page_id' => $page->id,
//
//	]);

//	$section->fields = $section->update([
//		'fields' => $request->fields
//	]);
	
	return response()->json([], 200);
});

Route::put('page-sections/order/', [
	'uses' => 'PageSectionsController@index'
]);

Route::delete('page-sections/{id}/', [
	'uses' => 'PageSectionsController@destroy'
]);

Route::post('page-sections/{id}/fields', [
	'uses' => 'PageSectionsController@updateFields'
]);


Route::post('page-sections/{id}/image', [
	'uses' => 'PageSectionsController@updateFieldImage'
]);


Route::get('/wordpress', function (Request $request) {
	
	$htmls = '';
	
	foreach ($request->ids as $id) {
		$section = \App\Domain\Sections\Models\Section::find($id);
		if ($section->blade_path) $htmls .= View::file(resource_path('sections/' . $section->blade_path))->render();
	}
	
	file_put_contents(public_path('custom-foo.blade.php'), $htmls);
	
	$response = Response::make($htmls, 200);
	$response->header('Content-Type', 'php');
	
	return Response::download(public_path('custom-foo.blade.php'), 'custom-' . $request->name ?? 'foo' . '.blade.php');
});


Route::resource('html-nodes', '\App\Domain\Sections\Http\Controllers\HtmlNodesController');
Route::resource('sections', '\App\Domain\Sections\Http\Controllers\SectionsController');

Route::resource('font_families', 'FontFamilyController');
Route::resource('fonts', 'FontsController');


Route::put('brands/{brand}/fonts', [
	'uses' => 'BrandFontsController@update'
]);



Route::get('/categories/', function () {
	$categories[] = [
		"id" => null,
		"name" => "All Sections",
		"section_count" => \App\Domain\Sections\Models\Section::all()->count()
	];

	$categories = array_merge($categories, \App\Domain\Sections\Models\SectionCategory::withCount('section')
		->get()
		->toArray());

	return $categories;
});

//Route::group(['prefix' => 'api'], function () {
//
//
//	Route::get('/css/{id}', function ($id) {
//		$section = \App\Section::findOrFail($id);
//
//		return $section->css;
//	});
//
//
//});
