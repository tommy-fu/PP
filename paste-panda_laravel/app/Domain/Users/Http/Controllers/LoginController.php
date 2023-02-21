<?php

namespace App\Domain\Users\Http\Controllers;

use App\Domain\Authentication\Actions\AuthenticateUser;
use App\Domain\Users\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginFormRequest;
use App\Services\ElasticService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
	public function show()
	{
		return view('users.login');
	}
	
	public function post(LoginFormRequest $request, AuthenticateUser $authenticateUser)
	{
		
		if ($authenticateUser->execute($request->all())) {
			
			if(!User::where('email', Request()->email)->first()->isAdmin()){
				return redirect()->back()
					->withErrors(['incorrect_credentials' => 'Only admins can currently sign in.'])
					->withInput(['email' => $request->email]);
			}
			
			ElasticService::addToElastic('Login', [
				'session.start' => Carbon::now()->toDateTimeString(),
			]);
			
			return redirect()->to('/');
		}
		
		return redirect()->back()
			->withErrors(['incorrect_credentials' => 'Incorrect email or password.'])
			->withInput(['email' => $request->email]);
	}
}
