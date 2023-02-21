<?php

namespace Tests\SchemeBuilder;

use App\ColorContrast\ColorItemV2;
use App\Domain\ColorSchemeBuilder\BaseSchemeBuilder;
use App\SchemeColorFormula;
use Tests\DbTestCase;

class SchemeBuilderTest extends DbTestCase
{
	
	/** @test */
	
	function it_can_get_the_correct_background()
	{
		SchemeColorFormula::factory()->create();
		SchemeColorFormula::factory()->create(['type' => 1]);
		
		$schemeBuilder = BaseSchemeBuilder::make('000000','f0f0f0');
		
		$this->assertEquals('#F0F0F0', $schemeBuilder->generate()['background']);
	}
	
	/** @test */
	
	function it_can_get_the_correct_color_contrast()
	{
		$formula = SchemeColorFormula::factory()->create();
		
		$schemeBuilder = BaseSchemeBuilder::make('000000','F0F0F0');
		
		$this->assertEquals('#F0F0F0', $schemeBuilder->generate()['background']);
		
		$this->assertEquals(false, $schemeBuilder->hasDarkBackground());
		
		$schemeBuilder = BaseSchemeBuilder::make('000000', '000000');
		
		$this->assertEquals(true, $schemeBuilder->hasDarkBackground());
	}
	
	
	/** @test */
	
	function it_can_set_fixed_values()
	{
		$formula = SchemeColorFormula::factory()->create();
		
		$colors = $formula->colors;
		$colors['h1']['fixed_value'] = '#999999';
		
		$formula->update([
			'colors' => $colors
		]);
		
		$schemeBuilder = BaseSchemeBuilder::make('000000', 'ffffff');
		
		$this->assertEquals('#999999', $schemeBuilder->generate()['h1']);
	}
	
	/** @test */
	
	function it_can_set_correct_saturation_and_blend()
	{
		$formula = SchemeColorFormula::factory()->create();
		
		$colors = $formula->colors;
//		$colors['image-blend']['fixed_value'] = '#fff';
		$colors['image-blend']['fixed_saturation'] = '0';
		$colors['image-blend']['fixed_brightness'] = '100';
		$colors['image-saturation']['fixed_value'] = '99';
		$colors['background_image-saturation']['fixed_value'] = '-99';
		$colors['background_image-blend']['fixed_value'] = '#CCCCCC';
		
		$formula->update([
			'colors' => $colors
		]);
		
		$schemeBuilder = BaseSchemeBuilder::make('000000', 'ffffff');
		
		$this->assertEquals('99', $schemeBuilder->generate()['image-saturation']);
		$this->assertEquals('#FFFFFF', $schemeBuilder->generate()['image-blend']);
		$this->assertEquals('-99', $schemeBuilder->generate()['background_image-saturation']);
		$this->assertEquals('#CCCCCC', $schemeBuilder->generate()['background_image-blend']);
	}
	
	
	/** @test */
	
	function it_can_set_fixed_saturation_and_fixed_brightness()
	{
		$formula = SchemeColorFormula::factory()->create();
		
		$colors = $formula->colors;
		$colors['h1']['fixed_saturation'] = 70;
		$colors['h1']['fixed_brightness'] = 50;
		
		$formula->update([
			'colors' => $colors
		]);
		
		$schemeBuilder = BaseSchemeBuilder::make('46A6FF', 'ffffff');

		$this->assertEquals(70, ColorItemV2::make($schemeBuilder->generate()['h1'])->getSaturation());
		$this->assertEquals(50, ColorItemV2::make($schemeBuilder->generate()['h1'])->getValue());
	}
	
	/** @test */
	
	function it_can_alter_brightness()
	{
		$formula = SchemeColorFormula::factory()->create();
		
		$colors = $formula->colors;
		$colors['h1']['fixed_brightness'] = 100;
		$colors['h1']['fixed_saturation'] = 100;
		$colors['h1']['altered_brightness'] = -75;
		$colors['h1']['altered_saturation'] = -70;
		
		$formula->update([
			'colors' => $colors
		]);
		
		$schemeBuilder = BaseSchemeBuilder::make('46A6FF', 'ffffff');
		
		$this->assertEquals(25, ColorItemV2::make(str_replace('#', '', $schemeBuilder->generate()['h1']))->getValue());
		$this->assertEquals(30, ColorItemV2::make(str_replace('#', '', $schemeBuilder->generate()['h1']))->getSaturation());
	}
	
	
	/** @test */
	
	function it_can_get_base_variables()
	{
		$formula = SchemeColorFormula::factory()->create();
		
		$colors = $formula->colors;
		
		$colors['muted']['fixed_saturation'] = 70;
		$colors['muted']['fixed_brightness'] = 50;
		
		$formula->update([
			'colors' => $colors
		]);
		
		$schemeBuilder = BaseSchemeBuilder::make('46A6FF', 'ffffff');
		
		$this->assertEquals(70, ColorItemV2::make($schemeBuilder->generate()['muted'])->getSaturation());
		$this->assertEquals(50, ColorItemV2::make($schemeBuilder->generate()['muted'])->getValue());
	}
}
