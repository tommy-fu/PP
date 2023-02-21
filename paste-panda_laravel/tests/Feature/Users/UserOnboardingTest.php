<?php

namespace Tests\Feature\Users;

use App\Domain\Onboarding\OnboardingSurvey;
use App\Domain\Users\User;
use Tests\DbTestCase;

class UserOnboardingTest extends DbTestCase
{
    /** @test */
    public function a_user_can_answer_to_onboarding_questions()
    {
        $user = Factory(User::class)->create([
            'email' => 'asd@asd.com',
            'password' => bcrypt('password'),
	        'onboarded' => 0
        ]);

        $this->actingAs($user);
        
        $this->post(route('onboarding_survey.store'), [
            'title_id' => 1,
            'website_type_id' => 1,
        ]);
//	        ->assertStatus(302);

        $this->assertDatabaseHas('onboarding_surveys', [
            'user_id' => $user->id,
            'title_id' => 1,
            'website_type_id' => 1,
        ]);
        
        $this->assertEquals(1, $user->onboarded);
    }

    /** @test */
    public function a_user_cannot_do_the_onboarding_survey_twice()
    {
        $user = Factory(User::class)->create([
            'email' => 'asd@asd.com',
            'password' => bcrypt('password'),
        ]);

        $this->actingAs($user);

        $this->post(route('onboarding_survey.store'), [
            'title_id' => 1,
            'website_type_id' => 1,
        ]);

        $this->post(route('onboarding_survey.store'), [
            'title_id' => 1,
            'website_type_id' => 1,
        ]);

        $this->assertCount(1, OnboardingSurvey::where('user_id', $user->id)->get());
    }

    /** @test */
    public function if_a_user_puts_in_other_as_title_the_user_will_get_an_error()
    {
        $user = Factory(User::class)->create([
            'email' => 'asd@asd.com',
            'password' => bcrypt('password'),
        ]);

        $this->actingAs($user);

        $this->post(route('onboarding_survey.store'), [
            'title_id' => 0,
            'website_type_id' => 1,
        ])->assertSessionHasErrors();

        $this->assertCount(0, OnboardingSurvey::where('user_id', $user->id)->get());
    }

    /** @test */
    public function if_a_user_puts_in_other_as_website_type_the_user_will_get_an_error()
    {
        $user = Factory(User::class)->create([
            'email' => 'asd@asd.com',
            'password' => bcrypt('password'),
        ]);

        $this->actingAs($user);

        $this->post(route('onboarding_survey.store'), [
            'title_id' => 1,
            'website_type_id' => 0,
        ])->assertSessionHasErrors();

        $this->assertCount(0, OnboardingSurvey::where('user_id', $user->id)->get());
    }

    /** @test */
    public function a_user_can_enter_a_text_if_selected_other_as_title()
    {
        $user = Factory(User::class)->create([
            'email' => 'asd@asd.com',
            'password' => bcrypt('password'),
        ]);

        $this->actingAs($user);

        $this->post(route('onboarding_survey.store'), [
            'title_id' => 0,
            'website_type_id' => 1,
            'custom_title' => 'Mercenary',
        ]);

        $this->assertDatabaseHas('onboarding_surveys', [
            'user_id' => $user->id,
            'title_id' => 0,
            'website_type_id' => 1,
            'custom_title' => 'Mercenary',
        ]);
    }

    /** @test */
    public function a_user_can_enter_a_text_if_selected_other_as_website_type()
    {
        $user = Factory(User::class)->create([
            'email' => 'asd@asd.com',
            'password' => bcrypt('password'),
        ]);

        $this->actingAs($user);

        $this->post(route('onboarding_survey.store'), [
            'title_id' => 1,
            'website_type_id' => 0,
            'custom_website_type' => 'Newsletters',
        ]);

        $this->assertDatabaseHas('onboarding_surveys', [
            'user_id' => $user->id,
            'title_id' => 1,
            'website_type_id' => 0,
            'custom_website_type' => 'Newsletters',
        ]);
    }

    /** @test */
    public function a_user_cannot_select_a_non_existing_title_id()
    {
        $user = Factory(User::class)->create([
            'email' => 'asd@asd.com',
            'password' => bcrypt('password'),
        ]);

        $this->actingAs($user);

        $this->post(route('onboarding_survey.store'), [
            'title_id' => 999,
            'website_type_id' => 1,
            'custom_website_type' => 'Newsletters',
        ])->assertSessionHasErrors();
    }

    /** @test */
    public function a_user_cannot_select_a_non_existing_website_type_id()
    {
        $user = Factory(User::class)->create([
            'email' => 'asd@asd.com',
            'password' => bcrypt('password'),
        ]);

        $this->actingAs($user);

        $this->post(route('onboarding_survey.store'), [
            'title_id' => 1,
            'website_type_id' => 999,
            'custom_website_type' => 'Newsletters',
        ])->assertSessionHasErrors();
    }

    /** @test */
    public function a_user_will_be_redirected_to_onboarding_if_not_boarded()
    {
        $user = Factory(User::class)->create([
        	'onboarded' => 0
        ]);

        $this->be($user);

        $this->get('/')
            ->assertRedirect(route('users.show_onboarding'));
    }
}
