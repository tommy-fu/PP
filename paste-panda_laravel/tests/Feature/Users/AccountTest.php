<?php

namespace Tests\Feature\Users;

use App\Domain\Onboarding\OnboardingSurvey;
use App\Domain\Users\User;
use Illuminate\Support\Facades\Hash;
use Tests\DbTestCase;

class AccountTest extends DbTestCase
{
    /** @test */
    public function a_user_can_visit_the_users_account_page()
    {
        //		$this->withoutExceptionHandling();
        $user = Factory(User::class)->create();

        OnboardingSurvey::create([
            'user_id' => $user->id,
            'title_id' => 1,
            'website_type_id' => 1,
        ]);
        //Request a password reset
        $this->actingAs($user)
            ->get(route('accounts.edit', ['id' => $user->id]))
//			->assertStatus(200)
//            ->assertSee($user->first_name)
            ->assertSessionDoesntHaveErrors();
    }

    /** @test */
    public function a_user_can_update_the_password()
    {
        //		$this->withoutExceptionHandling();
        $user = Factory(User::class)->create();
        //Request a password reset
        $this->actingAs($user)
            ->post(route('account.update_password'), [
                'current_password' => 'password',
                'password' => 'new_password',
                'password_confirmation' => 'new_password',
            ])
            ->assertStatus(302)
            ->assertSessionDoesntHaveErrors();

        //Check if the password matches
        $this->assertTrue(Hash::check('new_password', $user->fresh()->password));
    }

    /** @test */
    public function a_user_cannot_update_the_password_if_the_current_password_is_incorrect()
    {
        //		$this->withoutExceptionHandling();
        $user = Factory(User::class)->create();
        //Request a password reset
        $this->actingAs($user)
            ->post(route('account.update_password'), [
                'current_password' => 'incorrect',
                'password' => 'new_password',
                'password_confirmation' => 'new_password',
            ])
            ->assertStatus(302)
            ->assertSessionHasErrors(['current_password']);

        //Check if the password matches
        $this->assertFalse(Hash::check('new_password', $user->fresh()->password));
    }

    /** @test */
    public function a_user_can_update_account_settings()
    {
        $this->withoutExceptionHandling();
        $user = Factory(User::class)->create();
        //Request a password reset
        $this->actingAs($user)
            ->post(route('account.update'), [
                'first_name' => 'First name',
                'last_name' => 'Last name',
            ])
            ->assertStatus(302)
            ->assertSessionDoesntHaveErrors()
            ->assertSessionHas(['account_updated']);

        //Check if the password matches
        $this->assertEquals('First name', $user->fresh()->first_name);
        $this->assertEquals('Last name', $user->fresh()->last_name);
    }

    /** @test */
    public function a_user_cannot_update_account_settings_if_the_first_name_or_last_name_is_empty()
    {
        $user = Factory(User::class)->create();
        //Request a password reset
        $this->actingAs($user)
            ->post(route('account.update'), [
                'first_name' => '',
                'last_name' => '',
            ])
            ->assertStatus(302)
            ->assertSessionHasErrors(['first_name', 'last_name']);

        //Check if the password matches
//		$this->assertNotEquals('First name', $user->fresh()->first_name);
//		$this->assertNotEquals('Last name', $user->fresh()->last_name);
    }

    /** @test */
    public function a_user_cannot_update_the_password_if_the_password_confirmation_is_incorrect()
    {
        //		$this->withoutExceptionHandling();
        $user = Factory(User::class)->create();
        //Request a password reset
        $this->actingAs($user)
            ->post(route('account.update_password'), [
                'password' => 'new_password',
                'password_confirm' => 'incorrect',
            ])
            ->assertStatus(302)
            ->assertSessionHasErrors();

        //Check if the password matches
        $this->assertFalse(Hash::check('new_password', $user->fresh()->password));
    }
}
