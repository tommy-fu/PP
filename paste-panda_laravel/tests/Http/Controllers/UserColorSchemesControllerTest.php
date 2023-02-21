<?php

namespace Tests\Http\Controllers;

use App\Domain\Brand\Models\Brand;
use App\Domain\ColorThemes\ColorScheme;
use App\Domain\ColorThemes\ColorSchemeSet;
use App\Domain\Users\User;
use Tests\DbTestCase;

class UserColorSchemesControllerTest extends DbTestCase
{
	
	
	/** @test */
	
	function a_user_can_select_a_brand()
	{
		
		$brand = Factory(Brand::class)->create();
		
		$colorSchemeSet = Factory(ColorSchemeSet::class)->create();
		
		$brand->colorSchemeSets()->attach($colorSchemeSet->id);
		
		$colorSchemes = Factory(ColorScheme::class, 5)->create([
			'color_scheme_set_id' => $colorSchemeSet->id
		]);
		
		
		$user = Factory(User::class)->create([
			'brand_id' => $brand->id
		]);
		
		$this->be($user);
	
		$this->get(route('user-color-schemes.show', $colorSchemes->last()->id))
			->assertSessionHasNoErrors()
			->assertStatus(302);
		
		
		$this->assertEquals($colorSchemes->last()->id, $user->fresh()->colorScheme->id);
	}
	
	/** @test */
	
	function a_user_must_have_a_brand_to_set_color_scheme()
	{
		$brand = Factory(Brand::class)->create();
		
		$colorSchemeSet = Factory(ColorSchemeSet::class)->create();
		
		$brand->colorSchemeSets()->attach($colorSchemeSet->id);
		
		$colorSchemes = Factory(ColorScheme::class, 5)->create([
			'color_scheme_set_id' => $colorSchemeSet->id
		]);
		
		
		$user = Factory(User::class)->create();
		
		$this->be($user);
		
		$this->get(route('user-color-schemes.show', $colorSchemes->last()->id))
			->assertSessionHasNoErrors()
			->assertStatus(400);
		
		
		$user->update([
			'brand_id' => $brand->id
		]);
		
		
		$this->be($user->fresh())
			->get(route('user-color-schemes.show', $colorSchemes->last()->id))
			->assertSessionHasNoErrors()
			->assertStatus(302);
		
		
		$this->assertEquals($colorSchemes->last()->id, $user->fresh()->colorScheme->id);
		
	}
	
	
	/** @test */
	
	function a_user_cannot_select_a_scheme_from_another_brand_without_using_the_brand()
	{
	
		$brand = Factory(Brand::class)->create();
		
		$colorSchemeSet = Factory(ColorSchemeSet::class)->create();
		
		$brand->colorSchemeSets()->attach($colorSchemeSet->id);
		
		$colorSchemes = Factory(ColorScheme::class, 5)->create([
			'color_scheme_set_id' => $colorSchemeSet->id
		]);
		
		
		$brand2 = Factory(Brand::class)->create();
		
		$colorSchemeSet2 = Factory(ColorSchemeSet::class)->create();
		
		$brand2->colorSchemeSets()->attach($colorSchemeSet2->id);
		
		$colorSchemes2 = Factory(ColorScheme::class, 5)->create([
			'color_scheme_set_id' => $colorSchemeSet2->id
		]);
		
		
		$user = Factory(User::class)->create();
		
		$this->be($user);
		
		$this->get(route('user-color-schemes.show', $colorSchemes2->last()->id))
			->assertSessionHasNoErrors()
			->assertStatus(400);
	}
}
