<?php


namespace App\Domain\Sections\Tests\Feature;


use App\Domain\Sections\Models\Section;
use App\Domain\Users\User;
use Laravel\Passport\Passport;
use Tests\DbTestCase;

class UserSectionFeatureTest extends DbTestCase
{

	protected function setUp(): void
	{
		parent::setUp();
		
		try {
			\Artisan::call('elastic:create-index', ['index-configurator' =>  "App\SectionIndexConfigurator"]);
		}
		catch(\Exception $e){
		
		}
		
		\Artisan::call('scout:flush', ['model' =>  "App\Domain\Sections\Models\Section"]);
	}

	/** @test */
	
	function a_user_can_update_his_section_id() {
		
		$user = Factory(User::class)->create();
		
		Passport::actingAs($user);
		
		$section = Factory(Section::class)->create();
		
		$this->putJson('/api/users/sections/' . $section->id)
			->assertStatus(204);
		
		$this->assertEquals($section->id, $user->fresh()->section_id);
	}
	
	
	/** @test */
	
	function a_user_can_update_html() {
		
		$user = Factory(User::class)->create([
			'email' => 'vi.man93@gmail.com'
		]);
		
		$section = Factory(Section::class)->create();
		
		$user->update([
			'section_id' => $section->id
		]);
		
		Passport::actingAs($user);
		
		$this->putJson('/api/user/sections/', [
			'html' => 'foo'
		])
			->assertStatus(204);
		
		$this->assertEquals('foo', $user->section->html);
	}
	
	/** @test */
	
	function a_user_can_update_css() {
		
		$user = Factory(User::class)->create();
		
		$section = Factory(Section::class)->create();
		
		$user->update([
			'section_id' => $section->id
		]);
		
		Passport::actingAs($user);
		
		$this->putJson('/api/user/sections/', [
			'css' => 'updated css'
		])
			->assertStatus(204);
		
		$this->assertEquals('updated css', $user->section->css);
	}
	
	/** @test */
	
	function a_user_can_update_js() {
		
		$user = Factory(User::class)->create();
		
		$section = Factory(Section::class)->create();
		
		$user->update([
			'section_id' => $section->id
		]);
		
		Passport::actingAs($user);
		
		$this->putJson('/api/user/sections/', [
			'javascript' => 'updated js'
		])
			->assertStatus(204);
		
		$this->assertEquals('updated js', $user->section->javascript);
	}
}
