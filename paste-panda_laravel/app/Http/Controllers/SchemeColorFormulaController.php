<?php

namespace App\Http\Controllers;

use App\Domain\Brand\BrandVariables;
use App\Domain\Brand\Styles\GenerateColorSchemeMixerPageProperties;
use App\Domain\ColorThemes\Elements\Base\Colorable;
use App\SchemeColorFormula;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Inertia\Inertia;

class SchemeColorFormulaController extends Controller
{
    private $base = [
        'text',
        'border',
        'muted',
        'background_image-blend',
        'background_image-saturation',
        'image-blend',
        'image-saturation',
        'cursor_selection-text',
        'cursor_selection-background',
//			'overlay_solid',
        'divider',
//			'box-shadow',
        'social_media_icon-color',
    ];

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create()
    {
        $res = $this->generateColorVariables();

        $item = SchemeColorFormula::create([
            'name' => 'Test',
            'colors' => $res,
        ]);

        return redirect()->to('/scheme-color-formula/' . $item->id . '/edit');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Inertia\Response
     */
    public function edit($id, GenerateColorSchemeMixerPageProperties $generateColorSchemeMixerPageProperties)
    {
        Inertia::setRootView('Admin/layouts/dashboard_layout');

        $item = SchemeColorFormula::findOrFail($id);

        $item->colors = array_intersect_key($item->colors, $this->generateColorVariables()) + $this->generateColorVariables();

        $colors = collect($item->colors)
            ->map(function ($color) {
                return array_intersect_key($color, $this->getBase()) + $this->getBase();
            });

        $item->colors = $colors;

        if (! Request()->type) {
            Request()->request->add(['type' => 'base']);
        }

        $pageProperties = $generateColorSchemeMixerPageProperties->handle(Request()->type);

        return Inertia::render('Admin/SchemeGenerator/EditSchemeGenerator', [
            'formula' => fn () => $item,
            'elements' => $pageProperties['elements'],
            'types' => $pageProperties['pages'],
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        SchemeColorFormula::findOrFail($id)->update([
            'colors' => Request()->colors,
        ]);

        return redirect()->back();
    }

    /**
     * @return array
     */
    private function generateColorVariables(): array
    {
        $variables = BrandVariables::$styleVariables;

        $foo = collect($variables)
            ->filter(function ($variable) {
                return is_subclass_of($variable, Colorable::class);
            })
            ->flatMap(function ($variable) {
                return $variable::getFormulaKeys();
            });

        $res = [];

        foreach ($foo as $key) {
            $res[$key] = $this->getBase();
        }

        return $res;
    }

    private function getBase()
    {
        return [
            'fixed_value' => null,
            'fixed_hex' => null,
            'fixed_hue' => null,
            'fixed_saturation' => null,
            'fixed_brightness' => null,
            'altered_saturation' => null,
            'altered_brightness' => null,
            'opacity' => null,
            'fallback_variable' => null,
        ];
    }
}
