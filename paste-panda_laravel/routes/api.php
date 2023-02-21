<?php

use App\CssStylesCollection\SpecialComponents\Swiper;
use App\Domain\Sections\Events\SectionUpdated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
	return $request->user();
});

Route::group(['middleware' => ['auth:api']], function () {
	
	Route::get('/admin/sections', function (Request $request, \App\Domain\Sections\Actions\GetAdminSectionsAction $getSectionsAction) {
		return $getSectionsAction->execute();
	});
	
	Route::get('/sections', function (Request $request, \App\Domain\Sections\Actions\GetSectionsAction $getSectionsAction) {
		return $getSectionsAction->execute();
	});
	
	Route::get('/fragments', function (Request $request, \App\Domain\Sections\Actions\GetFragmentsAction $getFragmentsAction) {
		
		if (!Auth::user()->isAdmin()) {
			abort(403);
		}
		
		return $getFragmentsAction->execute();
	});
	
	Route::put('/users/sections/{id}', function ($id) {
		$section = \App\Domain\Sections\Models\Section::findOrFail($id);
		
		Auth::user()->update([
			'section_id' => $section->id
		]);
		
		return response()->json([
			'message' => 'User section id has been updated to: ' . $section->id
		], 204);
	});
	
	
	Route::put('/users/fragments/{id}', function ($id) {
		$fragment = \App\Fragment::findOrFail($id);
		
		Auth::user()->update([
			'fragment_id' => $fragment->id
		]);
		
		return response()->json([
			'message' => 'User fragment id has been updated to: ' . $fragment->id
		], 204);
	});
	
	Route::put('/user/fragments', function () {
		$fragment = \App\Fragment::findOrFail(Auth::user()->fragment_id);
		
		$data = [];
		
		if (Request()->html) $data['html'] = Request()->html;
		if (Request()->css) $data['css'] = Request()->css;
		if (Request()->javascript) $data['javascript'] = Request()->javascript;
		
		$fragment->update($data);
		
		\App\Domain\Sections\Events\FragmentUpdated::dispatch($fragment);
		
		return response()->json([
			'html' => $fragment->html
		], 204);
	});
	
	
	Route::get('/user/fragments', function () {
		$fragment = \App\Fragment::findOrFail(Auth::user()->fragment_id);
		
		return response()->json([
			'id' => $fragment->id,
			'html' => $fragment->html ?? '',
			'css' => $fragment->css ?? '',
			'javascript' => $fragment->javascript ?? '',
		], 200);
	});
	
	
	Route::get('/user/sections', function () {
		$section = \App\Domain\Sections\Models\Section::findOrFail(Auth::user()->section_id);
		
		return response()->json([
			'id' => $section->id,
			'html' => $section->html ?? '',
			'css' => $section->css ?? '',
			'javascript' => $section->javascript ?? '',
		], 200);
	});
	
	
	Route::put('/user/sections', function () {
		$section = \App\Domain\Sections\Models\Section::findOrFail(Auth::user()->section_id);
		
		$data = [];
		
		if (Request()->html) $data['html'] = Request()->html;
		if (Request()->css) $data['css'] = Request()->css;
		if (Request()->javascript) $data['javascript'] = Request()->javascript;
		
		$section->update($data);
		
		SectionUpdated::dispatch($section);
		
		return response()->json([
			'html' => $section->html
		], 204);
	});
	
	Route::get('/tags', [\App\Http\Controllers\TagsController::class, 'index']);
});
