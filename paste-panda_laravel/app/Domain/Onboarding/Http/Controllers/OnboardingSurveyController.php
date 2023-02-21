<?php

namespace App\Domain\Onboarding\Http\Controllers;

use App\Domain\Authentication\Actions\CreateOnboardingAnswers;
use App\Domain\Authentication\Actions\GetUserOnboardingAnswers;
use App\Domain\Onboarding\Http\Requests\OnboardingSurveyRequest;
use App\Domain\Onboarding\OnboardingSurvey;
use App\Domain\Onboarding\OnboardingSurveyTitle;
use App\Domain\Onboarding\OnboardingSurveyWebsiteType;
use App\Domain\Sections\Http\Controllers\SectionsController;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class OnboardingSurveyController extends Controller
{
    public function show()
    {
        if (OnboardingSurvey::where('user_id', \Auth::user()->id)->count() > 0) {
            return redirect()->to('/');
        }

        $ids = [1, 2, 3, 4, 5, 0];

        $onboardingSurveyTitles = OnboardingSurveyTitle::all();

        $onboardingSurveyTitles = $onboardingSurveyTitles->sortBy(function ($model) use ($ids) {
            return array_search($model->getKey(), $ids);
        });

        $onboardingSurveyWebsiteTypes = OnboardingSurveyWebsiteType::all();

        $onboardingSurveyWebsiteTypes = $onboardingSurveyWebsiteTypes->sortBy(function ($model) use ($ids) {
            return array_search($model->getKey(), $ids);
        });

        Inertia::setRootView('guest');
        
        return Inertia::render('Onboarding/ShowOnboarding', [
	        'titles' => $onboardingSurveyTitles,
	        'website_types' => $onboardingSurveyWebsiteTypes,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param OnboardingSurveyRequest $request
     * @param CreateOnboardingAnswers $createOnboardingAnswers
     * @param GetUserOnboardingAnswers $getUserOnboardingAnswers
     * @return Response
     */
    public function store(OnboardingSurveyRequest $request, CreateOnboardingAnswers $createOnboardingAnswers, GetUserOnboardingAnswers $getUserOnboardingAnswers)
    {
        if (!$getUserOnboardingAnswers->execute(Auth::user()->id)) {
            $createOnboardingAnswers->execute($request->all());
        }
        
	    return Inertia::location('/');
    }
}
