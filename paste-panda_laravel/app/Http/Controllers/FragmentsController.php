<?php

namespace App\Http\Controllers;

use App\Domain\ColorThemes\Colors;
use App\Domain\Sections\Models\Section;
use App\Fragment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FragmentsController extends Controller
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
	    if (!Auth::user()->isAdmin()) {
		    abort(403);
	    }
	
	    Colors::setScheme(Auth::user()->colorScheme);
	
	    $fragment = Fragment::findOrFail($id);
	
//	    $dependencies = $section->dependencies;
//
//	    $cssDependencies = $dependencies->filter(function ($dependency) {
//		    return $dependency->type == 1;
//	    })->pluck('url');
//
//	    $jsDependencies = $dependencies->filter(function ($dependency) {
//		    return $dependency->type == 2;
//	    })->pluck('url');
//
//	    $cssDependencies = $cssDependencies->map(function ($dependency) {
//		    return '<link rel="stylesheet" href="' . $dependency . '"/>';
//	    });
//
//	    $jsDependencies = $jsDependencies->map(function ($dependency) {
//		    return '<script type="text/javascript" src="' . $dependency . '"></script>';
//	    });
//
//
	    return view('fragments.fragments_show', [
		    'fragment' => $fragment,
//		    'cssDependencies' => $cssDependencies,
//		    'jsDependencies' => $jsDependencies
	    ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
