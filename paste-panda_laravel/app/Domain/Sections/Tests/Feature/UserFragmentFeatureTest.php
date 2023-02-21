<?php


namespace App\Domain\Sections\Tests\Feature;


use App\Domain\Sections\Models\Section;
use App\Domain\Users\User;
use App\Fragment;
use Laravel\Passport\Passport;
use Tests\DbTestCase;

class UserFragmentFeatureTest extends DbTestCase
{
	
	/** @test */
	
	function a_user_can_retrieve_his_fragment_data() {
		
		$user = Factory(User::class)->create();
		
		Passport::actingAs($user);
		
		$fragment = Fragment::factory()->create();
		
		$user->update([
			'fragment_id' => $fragment->id
		]);
		
		$this->getJson('/api/user/fragments/')
			->assertStatus(200);
		
	}
	
	
	/** @test */
	
	function a_user_can_update_his_section_id() {
		
		$user = Factory(User::class)->create();
		
		Passport::actingAs($user);
		
		$fragment = Fragment::factory()->create();
		
		$this->putJson('/api/users/fragments/' . $fragment->id)
			->assertStatus(204);
		
		$this->assertEquals($fragment->id, $user->fresh()->fragment_id);
	}
	
	
	/** @test */
	
	function a_user_can_update_html() {
		
		$user = Factory(User::class)->create([
			'email' => 'vi.man93@gmail.com'
		]);
		
		$fragment = Fragment::factory()->create();
		
		$user->update([
			'fragment_id' => $fragment->id
		]);
		
		Passport::actingAs($user);
		
		$this->putJson('/api/user/fragments/', [
			'html' => 'foo'
		])
			->assertStatus(204);
		
		$this->assertEquals('foo', $user->fragment->html);
	}
	
	/** @test */
	
	function a_user_can_update_css() {
		
		$user = Factory(User::class)->create();
		
		$fragment = Fragment::factory()->create();
		
		$user->update([
			'fragment_id' => $fragment->id
		]);
		
		Passport::actingAs($user);
		
		$this->putJson('/api/user/fragments/', [
			'css' => 'updated css'
		])
			->assertStatus(204);
		
		$this->assertEquals('updated css', $user->fragment->css);
	}
	
	/** @test */
	
	function a_user_can_update_js() {
		
		$user = Factory(User::class)->create();
		
		$fragment = Fragment::factory()->create();
		
		$user->update([
			'fragment_id' => $fragment->id
		]);
		
		Passport::actingAs($user);
		
		$this->putJson('/api/user/fragments/', [
			'javascript' => 'updated js'
		])
			->assertStatus(204);
		
		$this->assertEquals('updated js', $user->fragment->javascript);
	}
}
