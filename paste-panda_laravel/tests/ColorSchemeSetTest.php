<?php

namespace Tests;

use App\Domain\ColorThemes\ColorScheme;
use App\Domain\ColorThemes\ColorSchemeSet;

class ColorSchemeSetTest extends DbTestCase
{
	
	/** @test  */
	public function it_can_have_color_schemes(){
		
		$colorSchemeSets = Factory(ColorSchemeSet::class)->create();
		
		Factory(ColorScheme::class, 5)->create([
			'color_scheme_set_id' => $colorSchemeSets->id
		]);
		
		$this->assertCount(5, $colorSchemeSets->colorSchemes);
		
	}
}
