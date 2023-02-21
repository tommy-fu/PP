<?php

namespace Tests\Feature\Users;

use App\Domain\Onboarding\OnboardingSurvey;
use App\Domain\Users\User;
use Tests\DbTestCase;

class UserOnboardingModalTest extends DbTestCase
{

	
    /** @test */
    public function a_user_can_update_onboarding()
    {
        $user = Factory(User::class)->create();

        $this->be($user);
        
        $this->patch(route('users.show_onboarding.update'), [
        	'show_onboarding' => 1
        ]);
        
        $this->assertEquals(1, $user->fresh()->show_onboarding);
	
	    $this->patch(route('users.show_onboarding.update'), [
		    'show_onboarding' => 0
	    ]);
	
	    $this->assertEquals(0, $user->fresh()->show_onboarding);
    }
	
	/** @test */
	public function a_user_should_onboard_as_default()
	{
		$user = Factory(User::class)->create();
		
		$this->assertEquals(1, $user->fresh()->show_onboarding);
	}
}
