<?php

namespace App\Domain\Authentication\Actions;

use App\Domain\Users\Exceptions\EmailNotFoundException;
use App\Domain\Users\Exceptions\InvalidTokenException;
use App\Domain\Users\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ResetUserPassword
{
    public function execute($data)
    {
        $password = $data['password'];
        // Validate the token
        $tokenData = DB::table('password_resets')->where('token', $data['token'])->first();

        // Redirect the user back to the password reset request form if the token is invalid
        if (!$tokenData) {
            throw new InvalidTokenException('Token does not exist');
        }

        $user = User::where('email', $tokenData->email)->first();
        // Redirect the user back if the email is invalid
        if (!$user) {
            throw new EmailNotFoundException('Email not found');
        }
        //Hash and update the new password
        $user->password = \Hash::make($password);
        $user->update(); //or $user->save();

        //Delete the token
        DB::table('password_resets')->where('email', $user->email)->delete();

        //login the user immediately they change password successfully
        Auth::login($user);
    }
}
