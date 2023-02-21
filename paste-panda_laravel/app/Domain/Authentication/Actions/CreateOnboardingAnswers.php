<?php

namespace App\Domain\Authentication\Actions;

use App\Domain\Onboarding\OnboardingSurvey;
use Illuminate\Support\Facades\Auth;

class CreateOnboardingAnswers
{
    public function execute($data)
    {
        OnboardingSurvey::create([
            'user_id' => \Auth::user()->id,
            'title_id' => $data['title_id'],
            'website_type_id' => $data['website_type_id'],
            'custom_title' => $data['title_id'] == 0 ? $data['custom_title'] : null,
            'custom_website_type' => $data['website_type_id'] == 0 ? $data['custom_website_type'] : null,
        ]);
        
        
        Auth::user()->update([
        	'onboarded' => true
        ]);
    }
}
