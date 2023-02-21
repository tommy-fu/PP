<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageBuilderController extends Controller
{
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
	 * Edit the given page with the page builder.
	 *
	 * @param int|null $pageId
	 * @throws Throwable
	 */
	public function build($pageId = null)
	{
		$route = $_GET['route'] ?? null;
		$action = $_GET['action'] ?? null;
		$pageId = is_numeric($pageId) ? $pageId : ($_GET['page'] ?? null);
		$pageRepository = new \PHPageBuilder\Repositories\PageRepository;
		
		$page = $pageRepository->findWithId($pageId);
		
		$phpPageBuilder = app()->make('phpPageBuilder');
		$pageBuilder = $phpPageBuilder->getPageBuilder();
		
		$customScripts = view("pagebuilder.scripts")->render();
		$pageBuilder->customScripts('head', $customScripts);
		
		$pageBuilder->handleRequest($route, $action, $page);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
}
