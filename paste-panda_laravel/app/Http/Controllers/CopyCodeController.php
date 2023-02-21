<?php

namespace App\Http\Controllers;

use App\Domain\ColorThemes\Mock\ColorSchemeMock;
use App\Domain\Sections\Models\Section;
use App\Services\ElasticService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Response;

class CopyCodeController extends Controller
{
	/**
	 * Display the specified resource.
	 *
	 * @param Request $request
	 * @param int $id
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function show(Request $request)
	{
		app()->singleton('colors', function () {
			$scheme = Auth::user()->colorScheme;
			
			$mock = new ColorSchemeMock();
			
			$scheme->colors = array_intersect_key($scheme->colors, $mock->getVariables()->toArray()) + $mock->getVariables()->toArray();
			
			return $scheme->colors;
		});
		
		$user = Auth::user();
		
		$event = $user->programming_language_id == 0 ? 'CopyHTML' : 'CopyReact';
		
		$section = Cache::rememberForever('section-' . $request->section_id . '-name', function () use ($user) {
			return Section::findOrFail(Request()->section_id);
		});
		
		if (!$section->beta_section) {
			abort(401);
		}
		
		$colorScheme = $user->colorScheme;
		$colorTheme = $user->colorTheme;
		$brand = $user->brand;
		
		ElasticService::addToElastic($event, [
			'style.name' => $brand->name,
			'style.id' => $brand->id,
			'color_scheme.id' => $colorScheme->id,
			'color_theme.name' => $colorTheme->name,
			'color_theme.id' => $colorTheme->id,
			'section.id' => $section->id,
			'section.name' => $section->name,
			'section.category' => $section->section_category ? $section->section_category->name : '',
		]);

		
		if ($user->programming_language_id == 0) {
			$section = Section::findOrFail(Request()->section_id);
			
			$sectionName = $section->section_category ? $section->section_category->name : '';
			
			$codeToCopy = '<!-- ' . $sectionName . ' start -->' . PHP_EOL;
			$codeToCopy .= $section->rendered_html . PHP_EOL;
			$codeToCopy .= '<!-- ' . $sectionName . ' end -->' . PHP_EOL;
			
		} else {
			if ($user->programming_language_id == 1) {
				app()->singleton('programming_languages', function () use ($user) {
					return $user->fresh()->programming_language_id;
				});
			}
			
			$section = Section::findOrFail(Request()->section_id);
			
			$data = $section->rendered_html;
			
			if ($user->programming_language_id == 1) {
				$data = str_replace('"{{', '{{', $data);
				$data = str_replace('}}"', '}}', $data);
				$data = str_replace('classname', 'className', $data);
			}
			
			$sectionName = $section->section_category ? $section->section_category->name : '';
			
			$codeToCopy = '{/* ' . $sectionName . ' start */}' . PHP_EOL;
			$codeToCopy .= $data . PHP_EOL;
			$codeToCopy .= '{/* ' . $sectionName . ' end */}' . PHP_EOL;
		}

		$response = Response::make($codeToCopy, 200);
		$response->header('Content-Type', 'text/html');
		
		return $response;
//        return response()->json($data, 200);
	}
}
