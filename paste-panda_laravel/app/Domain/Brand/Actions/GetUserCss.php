<?php

namespace App\Domain\Brand\Actions;

use App\Domain\Brand\BrandVariables;
use App\Domain\ColorThemes\Mock\ColorSchemeMock;
use App\Services\CssFileGenerator;
use Illuminate\Support\Facades\Auth;

class GetUserCss
{
    private CssFileGenerator $brandServices;

    public function __construct()
    {
        $this->brandServices = new CssFileGenerator();
    }

    public function execute()
    {
        app()->singleton('colors', function () {
            $scheme = Auth::user()->colorScheme;

            $mock = new ColorSchemeMock();

            $scheme->colors = array_intersect_key($scheme->colors, $mock->getVariables()->toArray()) + $mock->getVariables()->toArray();

            return $scheme->colors;
        });

        app()->singleton('brand', function () {
            $brand = Auth::user()->brand;

            $brand->setVariables(json_encode($this->recursive_array_intersect_key($brand->variables, BrandVariables::getBrand2()) + BrandVariables::getBrand2()));

            return $brand;
        });

        return $this->brandServices->getCssFromBrand();
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
