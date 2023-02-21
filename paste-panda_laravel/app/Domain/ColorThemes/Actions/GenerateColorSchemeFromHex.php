<?php

namespace App\Domain\ColorThemes\Actions;

use App\ColorContrast\Color;
use App\BackgroundColorFormula;
use App\Services\ElasticService;
use Illuminate\Support\Facades\Auth;
use App\SchemeBuilder\ColorSchemeMixer;
use App\Domain\ColorThemes\ColorSchemeSet;

class GenerateColorSchemeFromHex
{
	public function execute($data)
	{
		$hex = str_replace('#', '', $data['hex']);
		
		if(strlen($hex) == 3){
			$hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
		}
		
		$jewelGenerator = new ColorSchemeMixer();
		
		$theme = ColorSchemeSet::create([
			'name' => $hex,
			'user_id' => Auth::user()->id,
		]);
		
		$backgrounds = BackgroundColorFormula::where('active', true)
			->get()
			->flatMap(function ($formula) use ($hex) {
				return $formula->generateBackgroundColors($hex);
			});
		
		foreach ($backgrounds as $key => $background) {
			//			if($this->hasGoodContrast($background, $hex)){
			$scheme = $jewelGenerator->getScheme($hex, $background);
			
			$theme->colorSchemes()->create([
				'name' => $hex,
				'colors' => $scheme,
				'order_column' => $key
			]);
			//			}
		}
		
		Auth::user()->update([
			'color_scheme_set_id' => $theme->id,
			'color_scheme_id' => $theme->colorSchemes()->ordered()->first()->id,
		]);
		
		$this->deleteOldUserSchemes($theme);

		$color = new Color($hex);

		$hsv = $color->toHsvInt();

		ElasticService::addToElastic('EnterHexV1', [
			'color.hex' => $hex,
			'color.input_hex' => $data['hex'],
			'color.hue' => $hsv['hue'],
			'color.saturation' => $hsv['sat'],
			'color.value' => $hsv['val'],
		]);

	}
	
	private function hasGoodContrast($background, $hex)
	{
		$color = new Color($background);
		
		return $color->getLuminance(new Color($hex)) > 3;
	}
	
	/**
	 * @param $theme
	 */
	private function deleteOldUserSchemes($theme): void
	{
		ColorSchemeSet::where('user_id', Auth::user()->id)
			->where('id', '!=', $theme->id)
			->delete();
	}
}
