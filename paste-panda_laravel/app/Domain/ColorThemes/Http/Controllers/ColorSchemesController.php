<?php

namespace App\Domain\ColorThemes\Http\Controllers;

use App\Domain\Brand\Styles\GenerateColorPageProperties;
use App\Domain\ColorThemes\Actions\GenerateColorSchemeFromHex;
use App\Domain\ColorThemes\Actions\UpdateColorScheme;
use App\Domain\ColorThemes\ColorScheme;
use App\Domain\ColorThemes\Elements\Base\Badge;
use App\Domain\ColorThemes\Elements\Base\Input;
use App\Domain\ColorThemes\Elements\Base\Link;
use App\Domain\ColorThemes\Elements\Base\TextBase;
use App\Domain\ColorThemes\Elements\Button;
use App\Http\Controllers\Controller;
use App\Http\Requests\ColorSchemeFormRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ColorSchemesController extends Controller
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
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(ColorSchemeFormRequest $request, GenerateColorSchemeFromHex $generateColorSchemeFromHex)
    {
//        try {
            $generateColorSchemeFromHex->execute(Request()->all());
//        } catch (\Exception $e) {
//            return redirect()->back()
//                ->withErrors([
//                    'hex' => 'Please enter a valid hex value.',
//                ]);
//        }
//

        return redirect()->back();
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
     * @return \Inertia\Response
     */
    public function edit($id, GenerateColorPageProperties $generateColorPageProperties)
    {
        if (! Auth::user()->isAdmin()) {
            abort(403);
        }

        $scheme = ColorScheme::findOrFail($id);
        
        if(!Request()->type) Request()->request->add(['type' => 'default']);
        if(!Request()->page) Request()->request->add(['page' => 'base']);

        $pageProperties = $generateColorPageProperties->handle($scheme, Request()->page, Request()->type == 'default' ? null : Request()->type);

        $types = [
            'default',
            'card',
            'overlay',
        ];

        Inertia::setRootView('Admin/layouts/dashboard_layout');

        return Inertia::render('Admin/ColorSchemes/EditColorScheme', [
            'scheme' => $scheme,
            'elements' => $pageProperties['elements'],
            'pages' => $pageProperties['pages'],
            'page' => Request()->page,
            'types' => $types,
            'type' => Request()->type,
            'sectionId' => 107,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param ColorScheme $colorScheme
     * @param UpdateColorScheme $action
     * @return RedirectResponse
     */
    public function update(Request $request, ColorScheme $colorScheme, UpdateColorScheme $action)
    {
        if (! Auth::user()->isAdmin()) {
            abort(403);
        }

        $action->execute($colorScheme, $request->all());

        return redirect()->back();
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
