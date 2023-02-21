<?php

namespace App\Http\Controllers;

use App\Actions\CreateWebflowAnimation;

class WebflowAnimationsController extends Controller
{
    public function show(CreateWebflowAnimation $createWebflowAnimation)
    {
        $webflowAnimation = $createWebflowAnimation->execute(Request()->file);

        return view('webflow_convert', [
            'animation' => $webflowAnimation,
            'animations' => $webflowAnimation->getSelectors(),
            'actionGroups' => $webflowAnimation->getActionGroups(),
        ]);
    }
}
