<?php

namespace App\SchemeBuilder;

use App\Domain\ColorSchemeBuilder\BaseSchemeBuilder;
use App\Domain\ColorSchemeBuilder\CardSchemeBuilder;
use App\Domain\ColorSchemeBuilder\OverlaySchemeBuilder;
use App\Domain\ColorThemes\Mock\ColorSchemeMock;

class ColorSchemeMixer
{
    public function getScheme($hex, $background)
    {
        $mock = (new ColorSchemeMock());
        //		dd($background);
        //		return collect([
        //			BaseSchemeBuilder::make($hex, $background)->generate(),
        //			OverlaySchemeBuilder::make($hex, '000000')->generate(),
        //			CardSchemeBuilder::make($hex, $background)->generate(),
        //			AnalogousColors::make($hex)
        //		])
        //			->flatten()
        //			->toArray();

        //		return array_intersect_key($variables, $mock->getVariables()->toArray()) + $mock->getVariables()->toArray();
        $res = array_intersect_key(BaseSchemeBuilder::make($hex, $background)->generate(), $mock->getVariables()->toArray()) + $mock->getVariables()->toArray();
        $res = array_merge($res, OverlaySchemeBuilder::make($hex, '000000')->generate());
//        $res = array_merge($res, CardSchemeBuilder::make($hex, str_replace('#', '', $res['divider']))->generate());
        $res = array_merge($res, CardSchemeBuilder::make($hex, str_replace('#', '', $res['card-background']))->generate());
        $res = array_merge($res, AnalogousColors::make($hex));

        return $res;
    }
}
