<?php

namespace App\Domain\Brand\Http\Controllers;

use App\Domain\Brand\Actions\UpdateStyle;
use App\Domain\Brand\BrandVariables;
use App\Domain\Brand\Models\Brand;
use App\Domain\Brand\Styles\GenerateStylePageProperties;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class BrandsController extends Controller
{
    public function edit($id, GenerateStylePageProperties $generateStylePageProperties)
    {
        if (! Auth::user()->isAdmin()) {
            abort(403);
        }

        Inertia::setRootView('Admin/layouts/dashboard_layout');

        $sectionId = 107;

        $brand = Brand::findOrFail($id);

        $brand->setVariables(json_encode($this->recursive_array_intersect_key($brand->variables, BrandVariables::getBrand2()) + BrandVariables::getBrand2()));
        //	    dd($brand->variables['card']['base_styles']);
        $styleProperties = $generateStylePageProperties->handle($brand, Request()->page);

        return Inertia::render('Admin/Styles/EditStyle', [
            'brand' => $brand,
            'elements' => $styleProperties['elements'],
            'pages' => $styleProperties['pages'],
            'page' => Request()->page,
            'sectionId' => $sectionId,
        ]);
    }

    public function update(Brand $brand, UpdateStyle $updateStyle)
    {
        if (! Auth::user()->isAdmin()) {
            abort(403);
        }

        $updateStyle->execute($brand, Request()->all());

        return redirect()->back();
    }

    public function recursive_array_intersect_key(array $array1, array $array2): array
    {
        $array1 = array_intersect_key($array1, $array2) + $array2;

        foreach ($array1 as $key => &$value) {
            if (is_array($value) && is_array($array2[$key])) {
                $value = $this->recursive_array_intersect_key($value, $array2[$key]);
            }
        }

        return $array1;
    }
}
