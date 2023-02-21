<?php

namespace Tests\Feature\Colors;

use App\Domain\Brand\Models\Brand;
use App\Domain\ColorThemes\ColorScheme;
use App\Domain\ColorThemes\ColorSchemeSet;
use App\Domain\Sections\Models\Section;
use App\Domain\Users\User;
use Tests\DbTestCase;

class UserCssTest extends DbTestCase
{
	/** @test */
	public function a_user_should_be_able_to_retrieve_css()
	{
		
		$style = Factory(Brand::class)->create();
		$colorTheme = Factory(ColorSchemeSet::class)->create();
		
//		$schemes = Factory(ColorScheme::class, 4)->create([
//			'color_scheme_set_id' => $colorTheme->id
//		]);
		
		foreach (range(1, 4) as $range) {
			Factory(ColorScheme::class)->create([
				'color_scheme_set_id' => $colorTheme->id,
				'order_column' => $range
			]);
		}
		
		$schemes = ColorScheme::all();
		
		$this->assertEquals(1, $schemes->get(0)->order_column);
		$this->assertEquals(2, $schemes->get(1)->order_column);
		$this->assertEquals(3, $schemes->get(2)->order_column);
		$this->assertEquals(4, $schemes->get(3)->order_column);
		
		
		$user = Factory(User::class)->create([
			'brand_id' => $style->id,
			'color_scheme_set_id' => $colorTheme->id,
			'color_scheme_id' => $schemes->first()->id,
		]);
		
		$this->be($user);
		
		$response = $this->get('/user-brands/')
			->assertStatus(200)
			->assertHeader('Content-Type', 'text/css; charset=UTF-8');
		
		
		$this->assertStringContainsString('.h1', $response->content());
		$this->assertStringContainsString('.card .h1', $response->content());
		$this->assertStringContainsString('.has-overlay-solid .h1', $response->content());
//		$this->assertStringContainsString('.scheme-1 h1', $response->content());
//		$this->assertStringContainsString('.scheme-2 .h1', $response->content());
//		$this->assertStringContainsString('.scheme-3 .h1', $response->content());
//		$this->assertStringContainsString('.scheme-4 .h1', $response->content());
	}
}
