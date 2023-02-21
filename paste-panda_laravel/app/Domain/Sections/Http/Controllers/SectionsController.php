<?php

namespace App\Domain\Sections\Http\Controllers;

use App\Domain\Brand\Models\Brand;
use App\Domain\ColorThemes\Colors;
use App\Domain\ColorThemes\ColorSchemeSet;
use App\Domain\Sections\Actions\DuplicateSectionAction;
use App\Domain\Sections\Actions\GetCategoriesAction;
use App\Domain\Sections\Actions\GetColorThemesAction;
use App\Domain\Sections\Actions\GetSectionAction;
use App\Domain\Sections\Actions\GetSectionCollectionsAction;
use App\Domain\Sections\Actions\GetSectionsAction;
use App\Domain\Sections\Actions\UpdateSectionAction;
use App\Domain\Sections\Events\SectionUpdated;
use App\Domain\Sections\Models\Section;
use App\Http\Controllers\Controller;
use App\LookupTagIndexConfigurator;
use App\Repositories\ITagRepository;
use App\Services\ElasticService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param GetColorThemesAction $getColorThemesAction
     * @param GetCategoriesAction $getCategoriesAction
     * @param GetSectionsAction $getSectionsAction
     * @param GetSectionCollectionsAction $getSectionCollectionsAction
     * @return Response
     */
    public function index(GetColorThemesAction $getColorThemesAction, ITagRepository $tagRepository,GetCategoriesAction $getCategoriesAction, GetSectionCollectionsAction $getSectionCollectionsAction)
    {
        Inertia::setRootView('app');

        $generatedTheme = ColorSchemeSet::with('colorSchemes')
            ->where('user_id', Auth::user()->id)
            ->select(['id', 'name'])
            ->first();

        if ($generatedTheme) {
            $generatedTheme->generated_theme;
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
            'section_collections' => $getSectionCollectionsAction->sexecute(),
            'categories' => $getCategoriesAction->sexecute(),
            'brands' => Brand::select('id', 'name', 'description')->where('public', 1)->get(),
            'category' => Request()->category ?? '',
            'section_collection' => Request()->section_collection ?? '',
            'color_themes' => $getColorThemesAction->execute(),
            'search' => Request()->search,
            'prod' => Request()->prod ?? 1,
            'draft' => Request()->draft ?? 1,
            'model' => Request()->model ?? 1,
            'tags' => $tagRepository->getAll(),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }

        Colors::setScheme(Auth::user()->colorScheme);

        $section = Section::findOrFail($id);

        $dependencies = $section->dependencies;

        $cssDependencies = $dependencies->filter(function ($dependency) {
            return $dependency->type == 1;
        })->pluck('url');

        $jsDependencies = $dependencies->filter(function ($dependency) {
            return $dependency->type == 2;
        })->pluck('url');

        $cssDependencies = $cssDependencies->map(function ($dependency) {
            return '<link rel="stylesheet" href="' . $dependency . '"/>';
        });

        $jsDependencies = $jsDependencies->map(function ($dependency) {
            return '<script type="text/javascript" src="' . $dependency . '"></script>';
        });


        return view('sections.sections_show', [
            'section' => $section,
            'cssDependencies' => $cssDependencies,
            'jsDependencies' => $jsDependencies,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit(Section $section, GetSectionAction $getSectionAction)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }

        Inertia::setRootView('sections');

        return Inertia::render('Admin/Sections/EditSection', [
            'section' => $getSectionAction->execute($section),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Section $section
     * @param UpdateSectionAction $updateSectionAction
     * @return RedirectResponse
     */
    public function update(Request $request, Section $section, UpdateSectionAction $updateSectionAction)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }

        $updateSectionAction->execute($section, $request->all());

        SectionUpdated::dispatch($section);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }

        $section = Section::findOrFail($id);

        $section->delete();

        return response()->json([], 204);
    }

    public function duplicate($id, DuplicateSectionAction $duplicateSectionAction)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }

        $newSection = $duplicateSectionAction->execute($id);

        return redirect()->to('/sections/' . $newSection->id . '/edit');
    }
}
