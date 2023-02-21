<?php

namespace Tests\Feature\Users;

use App\Domain\Brand\Models\Brand;
use App\Domain\Users\User;
use Tests\DbTestCase;

class UserBrandsTest extends DbTestCase
{
	/** @test */
	public function a_user_can_select_a_brand()
	{
		$brand = Factory(Brand::class)->create();
		
		$user = Factory(User::class)->create();
		
		$this->be($user);
		
		$this->put(route('user-brands.update', $brand->id))
			->assertSessionHasNoErrors()
			->assertStatus(302);
		
		
		$this->assertEquals($brand->id, $user->fresh()->brand->id);
	}
}
