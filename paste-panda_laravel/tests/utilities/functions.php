<?php

use App\Domain\Users\User;

function createUser(){
	$user = Factory(User::class)->create();
	
	\App\Domain\Onboarding\OnboardingSurvey::create([
		'user_id' => $user->id,
		'title_id' => 1,
		'website_id' => 1
	]);
	
	return $user;
}
