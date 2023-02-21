<?php

namespace App\Domain\PageBuilder\Http\Controllers;

use App\CssModule;
use App\Domain\ColorThemes\Colors;
use App\Domain\PageBuilder\Models\Page;
use App\Domain\PageBuilder\Models\PageSection;
use App\Domain\Sections\HtmlTags\HtmlTags;
use App\Http\Controllers\Controller;
use App\JavaScriptModule;
use App\SectionFragment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class PagesController extends Controller
{
    /**
     * @var HtmlTags|\Illuminate\Contracts\Foundation\Application|mixed
     */
    private $htmlTags;

    public function __construct()
    {
        $this->htmlTags = app(HtmlTags::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param Page $page
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function show(Page $page, Request $request)
    {
        Auth::user()->brand->addBrandToSingleton();

        CssModule::initializeSingleton();
        JavaScriptModule::initializeSingleton();
        SectionFragment::initializeSingleton();

        Colors::setScheme(Auth::user()->colorScheme);

        $page->load('sections');

        $sections = $page->sections->sortBy(function ($section) {
            return $section->pivot->order_column;
        });
        
        $service = new PageRenderService($sections);

        $renderedHtml = $service->getHtml();

        return view('pages.show_page', [
            'page' => $page,
            'html' => $renderedHtml,
            'sections' => $sections,
            'css' => $service->getCss(),
            'cssDependencies' => $service->getCssDependencies(),
            'jsDependencies' => $service->getJsDependencies(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        $categories = \App\Domain\Sections\Models\SectionCategory::withCount('sections')
            ->get();

        $sectionsCount = $categories->sum('sections_count');


        $sections = $page->sections()->pluck('sections.id')->toArray();

        array_unshift($sections, '8');

        $sections[] = 10;

        $ids = '';

        foreach ($sections as $key => $section) {
            if ($key == 0) {
                $ids .= '&id[]=' . $section;
            } else {
                $ids .= '&ids[]=' . $section;
            }
        }

        $iframeRoute = route('html.preview') . '?brandId=11&' . $ids;


        $pageSections = PageSection::where('page_id', $page->id)->get();

        foreach ($pageSections as $pageSection) {
            //		    dd($item);
            if ($pageSection->fields == null) {
                //		    	dd($pageSection->section);
                $pageSection->update([
                    'fields' => $pageSection->section->blade_fields,
                ]);
            }
        }


        $sections2 = $page->sections()
            ->with('section_category')
            ->withPivot('fields', 'id')
            ->get();

        //	    $fields = [
        //	    	[
        //	    		'key' => 'title',
        //			    'label' => 'Title',
        //			    'value' => 'Vi hjälper ungdomar att
        //					agera i en komplex verklighet
        //					​ genom ​meditation',
        //			    'type' => 'text'
        //		    ],
        //		    [
        //			    'key' => 'description',
        //			    'label' => 'Description',
        //			    'value' => 'This is a description',
        //			    'type' => 'textarea'
        //		    ],
        //		    [
        //			    'key' => 'button_text',
        //			    'label' => 'Button Text',
        //			    'value' => 'Buy now!',
        //			    'type' => 'text'
        //		    ],
        //		    [
        //			    'key' => 'image',
        //			    'label' => 'Image',
        //			    'value' => 'https://images.unsplash.com/photo-1600120429657-cbaa8d439551?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=60',
        //			    'type' => 'image'
        //		    ],
        //	    ];
//

        //	    dd(json_encode($fields));


        foreach ($sections2 as $item) {
            $fields = json_decode($item->pivot->fields, true);
            $item->page_section_id = $item->pivot->id;

            if ($item->html) {
                $field_array = [];

                if ($fields && is_array($fields)) {
                    $field_array = array_column($fields, 'value', 'key');
                }

                $item->html_code = \App\Services\BladeCompiler::compileString($item->html, $field_array);
            }
        }

        return view('pages.edit_page', [
            'page' => $page,
            'categories' => $categories,
            'all_sections_count' => $sectionsCount,
            'sections' => $sections,
            'code_sections' => $sections2,
            'project' => $page->project,
            'iframeRoute' => $iframeRoute,
        ]);
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
