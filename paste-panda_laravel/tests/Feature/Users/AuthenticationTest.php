<?php

namespace Tests\Feature\Users;

use App\Domain\Users\User;
use App\Events\UserLoggedOut;
use Tests\DbTestCase;

class AuthenticationTest extends DbTestCase
{
    /** @test */
    public function a_user_can_visit_the_login_page()
    {
        $this->assertGuest();
        $this->get(route('users.show_login'))
            ->assertStatus(200);
    }

    /** @test */
    public function a_user_can_sign_in()
    {
        $user = Factory(User::class)->create([
            'email' => 'asd@asd.com',
            'password' => bcrypt('password'),
        ]);

        $this->post(route('users.sign_in'), [
            'email' => 'asd@asd.com',
            'password' => 'password',
        ])
            ->assertStatus(302);

        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function a_user_cannot_sign_in_without_correct_password()
    {
        $user = Factory(User::class)->create([
            'email' => 'asd@asd.com',
            'password' => 'password',
        ]);

        $this->post(route('users.sign_in'), [
            'email' => 'asd@asd.com',
            'password' => 'incorrect_password',
        ])
            ->assertStatus(302);

        $this->assertGuest();

        $this->assertTrue(session()->hasOldInput('email'));
    }

    /** @test */
    public function a_user_can_sign_out()
    {
        \Event::fake(UserLoggedOut::class);

        $this->withoutExceptionHandling();
        $user = Factory(User::class)->create([
            'email' => 'asd@asd.com',
            'password' => bcrypt('password'),
        ]);

        $this->be($user);

        $this->get(route('users.sign_out'))
            ->assertStatus(302);

        $this->assertGuest();

        \Event::assertDispatched(UserLoggedOut::class);
    }
}
