<?php

namespace App\Domain\Authentication\Actions;

use App\Domain\Onboarding\OnboardingSurvey;

class GetUserOnboardingAnswers
{
    public function execute($userId)
    {
	    return OnboardingSurvey::where('user_id', $userId)->first();
    }
}
