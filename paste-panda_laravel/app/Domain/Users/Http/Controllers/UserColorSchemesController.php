<?php

namespace App\Domain\Users\Http\Controllers;

use App\Domain\ColorThemes\ColorScheme;
use App\Domain\Users\Actions\SetUserColorScheme;
use App\Http\Controllers\Controller;
use App\Services\ElasticService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class UserColorSchemesController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!Auth::user()->brand) {
            abort(400);
        }

        $colorTheme = ColorScheme::findOrFail($id);

        if (!Auth::user()->brand->colorSchemeSets->contains('id', $colorTheme->color_scheme_set_id)) {
            abort(400);
        }

        Auth::user()->update([
            'color_scheme_id' => $colorTheme->id,
        ]);

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @param SetUserColorScheme $setUserColorScheme
     * @return RedirectResponse
     */
    public function update($id, SetUserColorScheme $setUserColorScheme)
    {
        $currentColorThemeId = Auth::user()->color_scheme_set_id;
        $currentColorSchemeId = Auth::user()->color_scheme_id;

        $setUserColorScheme->execute($id);

        ElasticService::addToElastic('ChangeColorScheme', [
            'color_theme.from.id' => $currentColorThemeId,
            'color_theme.to.id' => Auth::user()->fresh()->color_scheme_set_id,
            'color_scheme.from.id' => $currentColorSchemeId,
            'color_scheme.to.id' => Auth::user()->fresh()->color_scheme_id,
        ]);

        return redirect()->back();
    }
}
