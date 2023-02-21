<?php

namespace App\Domain\PageBuilder\Http\Controllers;

use App\Domain\PageBuilder\Models\PageSection;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageSectionsController extends Controller
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
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function destroy($id)
	{
		$section = \App\Domain\PageBuilder\Models\PageSection::find($id);
		
		$section->delete();
		
		return response()->json([], 204);
	}
	
	public function reorder(Request $request)
	{
		PageSection::setNewOrder($request->ids);
		
		return response()->json([], 204);
	}
	
	public function updateFields($id, Request $request)
	{
		$section = \App\Domain\PageBuilder\Models\PageSection::find($id);
		
		$section->fields = $section->update([
			'fields' => $request->fields
		]);
		
		return response()->json([], 200);
	}
	
	public function updateFieldImage($id, Request $request)
	{
		$section = \App\Domain\PageBuilder\Models\PageSection::find($id);
		
		$imagesService = new \App\Services\ImagesService();
		$imagesService->addOrReplaceFiles($section, $request->file, $request->key);
		
		$fields = $section->fields;
		
		foreach ($fields as &$field) {
			if ($field['key'] == $request->key) {
				$field['value'] = $section->getMedia($request->key)[0]->getUrl();
			}
		}
		
		$section->update([
			'fields' => $fields
		]);
//	$section->fields = $section->update([
//		'fields' => $request->fields
//	]);
		
		return response()->json($section->fields, 200);
	}
}
