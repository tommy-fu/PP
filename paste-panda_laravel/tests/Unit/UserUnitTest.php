<?php

namespace Tests\Unit;

use App\Domain\Sections\Models\Section;
use App\Domain\Users\User;
use Tests\DbTestCase;

class UserUnitTest extends DbTestCase
{
    /** @test */
    public function only_pastepanda_members_are_admins()
    {
        $user = Factory(User::class)->create(['email' => 'viman@pastepanda.com']);
        $this->assertTrue($user->isAdmin());

        $user = Factory(User::class)->create(['email' => 'tommy@pastepanda.com']);
        $this->assertTrue($user->isAdmin());

        $user = Factory(User::class)->create(['email' => 'tim@pastepanda.com']);
        $this->assertTrue($user->isAdmin());

        $user = Factory(User::class)->create(['email' => 'vi.man93@gmail.com']);
        $this->assertTrue($user->isAdmin());

        $user = Factory(User::class)->create(['email' => 'guest@fraud.com']);
        $this->assertFalse($user->isAdmin());
    }

    /** @test */
    public function a_users_initials_consist_of_first_letter_of_first_name_and_last_name()
    {
        $user = Factory(User::class)->create([
            'first_name' => 'Frodo JR',
            'last_name' => 'Baggins',
        ]);

        $this->assertEquals('FB', $user->getNameInitials());
    }

    /** @test */
    public function a_users_initials_consist_of_one_letter_if_no_last_name()
    {
        $user = Factory(User::class)->create([
            'first_name' => 'Frodo',
            'last_name' => '',
        ]);

        $this->assertEquals('F', $user->getNameInitials());
    }

    /** @test */
    public function a_users_initials_consist_of_one_letter_if_no_first_name()
    {
        $user = Factory(User::class)->create([
            'first_name' => '',
            'last_name' => 'Baggins',
        ]);

        $this->assertEquals('B', $user->getNameInitials());
    }

    /** @test */
    public function a_user_can_get_answered_sections_as_a_reward()
    {
    	$this->markTestSkipped();
        $user = Factory(User::class)->create([
            'first_name' => 'Frodo',
            'last_name' => 'Baggins',
//			'survey_answered' => 0
        ]);

        Factory(Section::class, 20)->create([
            'survey_reward' => 1,
        ]);

        $this->assertCount(0, $user->getSections());

        $user->update([
            'survey_answered' => 1,
        ]);

        $this->assertEquals(1, $user->survey_answered);
        $this->assertCount(20, $user->getSections());
    }
}
