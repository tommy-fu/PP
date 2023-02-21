<?php

namespace App\Domain\Users\Http\Controllers;

use App\Domain\Brand\Actions\GetUserCss;
use App\Domain\Users\Actions\SetUserBrandId;
use App\Http\Controllers\Controller;
use App\Services\ElasticService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Response;
use ScssPhp\ScssPhp\Compiler;

class UserBrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param GetUserCss $getUserCss
     * @return \Illuminate\Http\Response
     */
    public function index(GetUserCss $getUserCss)
    {
        $id = Auth::user()->brand_id . Auth::user()->color_scheme_id;

//        $css = Cache::rememberForever('brands-' . $id, function () use ($getUserCss) {
//            return $getUserCss->execute();
//        });
//
	    $css = $getUserCss->execute();
	    $user = Auth::user();
	
	    $colorScheme = $user->colorScheme;
	    $colorTheme = $user->colorTheme;
	    $brand = $user->brand;
	    
	    ElasticService::addToElastic('CopyCSS', [
		    'style.name' => $brand->name,
		    'style.id' => $brand->id,
		    'color_scheme.id' => $colorScheme->id,
		    'color_theme.name' => $colorTheme->name,
		    'color_theme.id' => $colorTheme->id,
	    ]);
	
	
	    $response = Response::make($css, 200);
        $response->header('Content-Type', 'text/css');

        return $response;
    }

    public function getLibrary(GetUserCss $getUserCss)
    {
        $id = Auth::user()->brand_id . Auth::user()->color_scheme_id;

        $scss = Cache::rememberForever('brands-' . $id . 'scss', function () use ($getUserCss) {
            $css = $getUserCss->execute();
            $scss = new Compiler();

            return $scss->compile('.library {' . $css . '}');
        });
//	    $css = $getUserCss->execute();
//	    $scss = new Compiler();
//
//	    $scss = $scss->compile('.library {' . $css . '}');


//	    $css = $getUserCss->execute();
//	    $scss = new Compiler();
//
//	    $scss = $scss->compile('.library {' . $css . '}');

        $response = Response::make($scss, 200);
        $response->header('Content-Type', 'text/css');

        return $response;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @param SetUserBrandId $setUserBrandId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, SetUserBrandId $setUserBrandId)
    {
        $setUserBrandId->execute($id);

        return redirect()->back();
    }
}
