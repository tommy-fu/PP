<?php

namespace App\Domain\Brand\Actions;

use App\Domain\Brand\Font;
use App\Domain\Brand\Models\Brand;
use Illuminate\Support\Facades\Artisan;

class UpdateStyle
{
    public function execute(Brand $brand, $data)
    {
        $vars = collect($data['variables'])
            ->filter(function ($variable) {
            	if(count($variable) == 0) return false;
            	
                return key_exists('font-family', $variable['base_styles']);
            })
            ->map(function ($variable) {
                return $variable['base_styles']['font-family'];
            })->unique()
            ->values()->flatten();

        //		$brand->fonts()->detach();

        $fonts = Font::whereHas('fontFamily', function ($q) use ($vars) {
            return $q->whereIn('name', $vars);
        })
            ->select('id')
            ->get()
            ->pluck('id');

        $brand->fonts()->sync($fonts);

        $brand->update([
            'variables' => $data['variables'],
        ]);
	
	    Artisan::call('cache:clear');
    }
}
