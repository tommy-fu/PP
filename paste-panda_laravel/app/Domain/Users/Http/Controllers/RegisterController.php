<?php

namespace App\Domain\Users\Http\Controllers;

use App\Domain\Users\Actions\RegisterUser;
use App\Domain\Users\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterFormRequest;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function show()
    {
        return view('users.register');
    }

    public function post(RegisterFormRequest $request, RegisterUser $registerUser)
    {
	
	    if(!env('ENABLE_REGISTRATION')) abort(403);
	    
        $user = $registerUser->execute($request->all());
	
	    if($user->isAdmin()){
		    Auth::loginUsingId($user->id);
	    }
	    
        return redirect()->to('/');
    }
}
