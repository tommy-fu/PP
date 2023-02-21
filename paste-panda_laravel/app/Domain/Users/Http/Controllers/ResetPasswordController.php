<?php

namespace App\Domain\Users\Http\Controllers;

use App\Domain\Authentication\Actions\ResetUserPassword;
use App\Domain\Users\Exceptions\EmailNotFoundException;
use App\Domain\Users\Exceptions\InvalidTokenException;
use App\Domain\Users\Http\Requests\ResetPasswordRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ResetPasswordController extends Controller
{
    public function show($token)
    {
	    $userResetData = DB::table('password_resets')
		    ->where('token', $token)->first();
	    
	    
	    return view('users/reset_password', [
		    'data' => $userResetData,
	    ]);
    }
	
	public function store(ResetPasswordRequest $request, ResetUserPassword $resetUserPassword)
	{
		try {
			$resetUserPassword->execute($request->all());
		} catch (EmailNotFoundException $e) {
			return redirect()->back()->withErrors(['email' => 'Email not found']);
		} catch (InvalidTokenException $e) {
			return view('auth.passwords.email');
		}
		
		return redirect()->to('/');
	}
}
