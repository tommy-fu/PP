<?php

namespace App\Http\Middleware;

use App\Domain\Onboarding\Http\Controllers\OnboardingSurveyController;
use App\Domain\Onboarding\OnboardingSurvey;
use Closure;
use Illuminate\Support\Facades\Auth;

class OnboardingMiddleware
{
	/**
	 * Handle an incoming request.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param \Closure $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if (!Auth::user()->onboarded) {
			
			if (OnboardingSurvey::where('user_id', \Auth::user()->id)->count() == 0) {
				return redirect()->action([OnboardingSurveyController::class, 'show']);
			}
			else{
				Auth::user()->update([
					'onboarded' => true
				]);
			}
			
		}
		
		return $next($request);
	}
}
