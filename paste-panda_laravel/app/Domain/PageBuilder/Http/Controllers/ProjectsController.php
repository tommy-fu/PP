<?php

namespace App\Domain\PageBuilder\Http\Controllers;

use App\Domain\PageBuilder\Models\Project;
use App\Domain\Sections\Models\Section;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use ZanySoft\Zip\Zip;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::where('user_id', \Auth::user()->id)
	        ->get();
        
        return view('projects.projects_index', [
        	'projects' => $projects
        ]);
    }

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
	
	/**
	 * Display the specified resource.
	 *
	 * @param Project $project
	 * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
    public function show(Project $project)
    {
        return view('projects.projects_show', [
        	'project' => $project
        ]);
    }
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param Project $project
	 * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
    public function edit(Project $project)
    {
	
	    $categories = \App\Domain\Sections\Models\SectionCategory::withCount('sections')
		    ->get();
	
	    $sectionsCount = $categories->sum('sections_count');
//
//	    $sections = \App\Models\Section::orderBy('requires_pro', 'asc')
//		    ->get();
//
	    
	    
	    
	    $sections = $project->sections()->pluck('sections.id');
	
	    $ids = '';
	    foreach ($sections as $key => $section) {
	    	
	    	if($key == 0){
			    $ids .= '&id[]=' . $section;
		    }
	    	else{
			    $ids .= '&ids[]=' . $section;
		    }
		    
	    }
	    
	    $iframeRoute = route('html.preview') . '?brandId=11&' . $ids;
    	
    	return view('projects.edit_project', [
    		'project' => $project,
		    'categories' => $categories,
		    'all_sections_count' => $sectionsCount,
		    'sections' => $sections,
		    'iframeRoute' => $iframeRoute
	    ]);
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
	
	public function convertToWordpress(Project $project){
		
		
		$zip = Zip::open(resource_path("/starter_kits/sage.zip"));
//		//When
		$zip->extract(public_path('/sage/'));
		
		foreach ($project->pages as $page) {
			
			$html = '';
			

			
			foreach ($page->sections as $section) {
				$html .= View::file(resource_path('sections/' . $section->blade_path))->render();
			}
			
			if($page->page_type_id == 1){
				
				$res = "{{--
  Template Name: Custom Template $page->name
--}}
" . PHP_EOL . PHP_EOL;

				$res .= "@extends('layouts.app')

@section('content')" . PHP_EOL . PHP_EOL;
				
				
				$res .= View::file(resource_path('blade/wordpress/custom-template.blade.php'), ['content' => $html])->render();
				
				$res .= "@endsection" . PHP_EOL;
				
				file_put_contents(public_path('stillin/template-' . strtolower($page->name) . '.blade.php'), $res);
				file_put_contents(public_path('sage/sage/resources/views/template-' . strtolower($page->name) . '.blade.php'), $res);
			}
			
			if($page->page_type_id == 2){
				file_put_contents(public_path('stillin/single.blade.php'), $html);
				file_put_contents(public_path('sage/sage/resources/views/single.blade.php'), $html);
			}
    	}
		
		//Add header
		$header = Section::find(8);
		$html = View::file(resource_path('sections/' . $header->blade_path))->render();
		file_put_contents(public_path('sage/sage/resources/views/partials/header.blade.php'), $html);
		
		//Add footer
		$footer = Section::find(10);
		$html = View::file(resource_path('sections/' . $footer->blade_path))->render();
		file_put_contents(public_path('sage/sage/resources/views/partials/footer.blade.php'), $html);
		
		$zip2 = Zip::create('wordpress.zip');
		
		$zip2->add(public_path('sage/sage'));
		
		$zip2->close();
		
		return response()->download(public_path('wordpress.zip'))->deleteFileAfterSend();
    }
}
