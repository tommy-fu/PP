<?php

namespace Tests\Feature\Users;

use App\Domain\Users\User;
use Illuminate\Support\Facades\Hash;
use Tests\DbTestCase;

class RegisterTest extends DbTestCase
{
	
	/** @test */
	public function a_user_can_visit_the_register_page()
	{
		$this->assertGuest();
		$this->get(route('users.register'))
			->assertStatus(200);
	}
	
	
	/** @test */
    public function a_user_can_sign_up()
    {
        $this->post(route('users.register'), [
            'name' => 'asd',
            'first_name' => 'First',
            'last_name' => 'Last',
            'email' => 'asd@asd.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'terms' => 1,
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'asd@asd.com',
            'first_name' => 'First',
            'last_name' => 'Last',
        ]);

        $newUser = User::where('email', 'asd@asd.com')->first();

        $this->assertTrue(Hash::check('password', $newUser->password));
    }

    /** @test */
    public function a_user_can_sign_up_and_then_login()
    {
        $this->post(route('users.register'), [
            'name' => 'asd',
            'first_name' => 'First',
            'last_name' => 'Last',
            'email' => 'asd@asd.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'terms' => 1,
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'asd@asd.com',
            'first_name' => 'First',
            'last_name' => 'Last',
        ]);

        $newUser = User::where('email', 'asd@asd.com')->first();

        $this->assertTrue(Hash::check('password', $newUser->password));

        $this->post(route('users.sign_in'), [
            'email' => 'asd@asd.com',
            'password' => 'password',
        ])
            ->assertStatus(302);

        $this->assertAuthenticatedAs($newUser);
    }
}
