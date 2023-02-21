<?php

namespace Tests\Feature\Users;

use App\Domain\Users\User;
use App\Mail\PasswordResetMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Tests\DbTestCase;

class PasswordTest extends DbTestCase
{
    /** @test */
    public function a_user_can_reset_the_password()
    {
        Mail::fake();
        $this->withoutExceptionHandling();
        $user = Factory(User::class)->create();

        //Request a password reset
        $this->post(route('forgot-password.store'), [
            'email' => $user->email,
        ])
            ->assertSessionDoesntHaveErrors();

        //Check if password reset contains email from the requested user
        $userResetData = DB::table('password_resets')
            ->where('email', $user->email)->first();

        $this->assertNotNull($userResetData);

        Mail::assertQueued(PasswordResetMail::class);

        
        $this->assertGuest();

        //Reset the password with the sent token
        $this->post(route('reset-password.store'), [
            'email' => $user->email,
            'password' => 'new_password',
            'password_confirmation' => 'new_password',
            'token' => $userResetData->token,
        ])
            ->assertStatus(302)
            ->assertSessionDoesntHaveErrors();

        //Check if user is now authenticated
        $this->assertAuthenticated();

        //Check if the password matches
        $this->assertTrue(Hash::check('new_password', $user->fresh()->password));
    }

    /** @test */
    public function a_password_reset_mail_wont_be_sent_if_the_given_email_doesnt_exist()
    {
        Mail::fake();

        $user = Factory(User::class)->create();

        //Request a password reset
        $this->post(route('forgot-password.store'), [
            'email' => 'non-existant@mail.com',
        ])
            ->assertStatus(302)
            ->assertSessionDoesntHaveErrors();

        //Check if password reset contains email from the requested user
        $userResetData = DB::table('password_resets')
            ->where('email', $user->email)->first();

        $this->assertNull($userResetData);

        Mail::assertNotSent(PasswordResetMail::class);
    }
}
