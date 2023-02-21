<?php

namespace Tests\Feature\Users\Invitation;

use App\Domain\Brand\Models\Brand;
use App\Domain\ColorThemes\ColorScheme;
use App\Domain\ColorThemes\ColorSchemeSet;
use App\Domain\Users\User;
use App\Mail\UserInvitationEmail;
use Illuminate\Support\Facades\Mail;
use Junaidnasir\Larainvite\Facades\Invite;
use Tests\DbTestCase;

class InvitationFeatureTest extends DbTestCase
{
    /** @test */
    public function an_admin_can_send_an_email()
    {
        Mail::fake();

        Factory(User::class, 10)->create();

        $user = Factory(User::class)->create([
            'email' => 'viman@pastepanda.com',
        ]);

        $this->be($user)
            ->post(route('invites.store'), [
                'email' => 'admin@admin.se',
            ])
            ->assertSessionHasNoErrors();

        $this->assertDatabaseHas('user_invitations', [
            'email' => 'admin@admin.se',
            'user_id' => $user->id,
        ]);

        Mail::assertQueued(UserInvitationEmail::class);
    }

    /** @test */
    public function a_non_admin_cannot_send_an_invite()
    {
        $users = Factory(User::class, 10)->create();

        $user = $users->first();

        $response = $this
            ->be($user)
            ->post(route('invites.store'), [
                'email' => 'admin@admin.se',
            ])
            ->assertStatus(403);
    }

    /** @test */
    public function a_guest_can_accept_an_invitation()
    {
    	
        $user = Factory(User::class)->create([
            'email' => 'viman@pastepanda.com',
        ]);

        Factory(Brand::class)->create();
        $colorTheme = Factory(ColorSchemeSet::class)->create();

        Factory(ColorScheme::class, 4)->create([
            'color_scheme_set_id' => $colorTheme->id,
        ]);

        $code = Invite::invite('john.doe@gmail.com', $user->id);

        $this->be($user)
            ->post(route('accept_invites.store'), [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'password' => 'johndoe',
                'password_confirmation' => 'johndoe',
                'email' => 'john.doe@gmail.com',
                'code' => $code,
                'terms' => true,
            ]);

        $this->assertDatabaseHas('users', [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john.doe@gmail.com',
        ]);

        $invite = Invite::get($code);

        $this->assertEquals('successful', $invite->status);
	
	    $this->be($user)
		    ->post(route('accept_invites.store'), [
			    'first_name' => 'John',
			    'last_name' => 'Doe',
			    'password' => 'johndoe',
			    'password_confirmation' => 'johndoe',
			    'email' => 'john.doe@gmail.com',
			    'code' => $code,
			    'terms' => true,
		    ])
		    ->assertSessionHasErrors('email');
	    
//        $this->be($user)
//            ->post(route('accept_invites.store'), [
//                'first_name' => 'John',
//                'last_name' => 'Doe',
//                'password' => 'johndoe',
//                'password_confirmation' => 'johndoe',
//                'email' => 'john.doe@gmail.com',
//                'code' => $code,
//                'terms' => true,
//            ])
//            ->assertSessionHasErrors('code');
    }

    /** @test */
    public function only_an_admin_can_visit_the_send_invites_pages()
    {
        $this->assertGuest();

        $this->get(route('invites.create'))
            ->assertStatus(302);

        $user = Factory(User::class)->create([
            'email' => 'john@doe.com',
        ]);

        $this->be($user)
            ->get(route('invites.create'))
            ->assertStatus(403);

        $admin = Factory(User::class)->create([
            'email' => 'viman@pastepanda.com',
        ]);

        $this->be($admin)
            ->get(route('invites.create'))
            ->assertStatus(200);
    }
}
