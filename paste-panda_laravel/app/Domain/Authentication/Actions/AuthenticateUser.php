<?php

namespace App\Domain\Authentication\Actions;

use Illuminate\Support\Facades\Auth;

class AuthenticateUser
{
    public function execute($data)
    {
	    $credentials = [
		    'email' => $data['email'],
		    'password' => $data['password'],
	    ];
	
	    return Auth::attempt($credentials);
    }
}
