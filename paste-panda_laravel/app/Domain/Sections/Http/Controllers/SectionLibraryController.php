<?php

namespace App\Domain\Sections\Http\Controllers;

use App\Domain\Brand\Models\Brand;
use App\Domain\ColorThemes\ColorSchemeSet;
use App\Domain\Sections\Models\Section;
use App\Domain\Sections\Models\SectionCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class SectionLibraryController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Inertia\Response
	 */
	public function index()
	{
		$categories = SectionCategory::withCount('sections')
			->having('sections_count', '>', 0)
			->get();
		
		$sectionsCount = Section::all()
			->where('beta_section', 1)
			->count();
		
		$categories->prepend([
			'name' => 'All sections',
			'sections_count' => $sectionsCount,
			'slug' => ''
		]);
		
		
		return Inertia::render('Sections', [
			'user' => [
				'initials' => Auth::user()->getNameInitials(),
				'brandId' => Auth::user()->brand_id,
				'color_scheme_set_id' => Auth::user()->color_scheme_set_id,
				'color_scheme_id' => Auth::user()->color_scheme_id,
			],
			'categories' => $categories,
			'brands' => Brand::all(),
			'category' => Request()->category ?? '',
			'themes' => ColorSchemeSet::with('colorSchemes')->get(),
		]);
	}
}
