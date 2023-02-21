<?php

namespace Tests\Models;

use App\Domain\Brand\Models\Brand;
use App\Domain\ColorThemes\ColorSchemeSet;
use Tests\DbTestCase;

class BrandTest extends DbTestCase
{
	
	
	/** @test  */
	public function it_can_have_color_scheme_sets(){
		
		$brand = Factory(Brand::class)->create();
		
		$colorSchemeSets = Factory(ColorSchemeSet::class, 3)->create();
		
		$brand->colorSchemeSets()->sync($colorSchemeSets->pluck('id'));
		
		$this->assertCount(3, $brand->colorSchemeSets);
		
	}

	
	/** @test  */
	public function it_can_have_a_description(){
		
		$brand = Factory(Brand::class)->create([
			'description' => 'This is a description'
		]);
		
		$this->assertEquals('This is a description', $brand->description);
	}
}
