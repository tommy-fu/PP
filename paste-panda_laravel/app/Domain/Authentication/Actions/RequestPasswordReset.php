<?php

namespace App\Domain\Authentication\Actions;

use App\Domain\Users\User;
use App\Mail\PasswordResetMail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class RequestPasswordReset
{
    public function execute($data)
    {
        $emailExists = User::where('email', $data['email'])->count() > 0;

        if ($emailExists) {
            //Create Password Reset Token
            $token = \Str::random(60);
            DB::table('password_resets')->insert([
                'email' => $data['email'],
                'token' => $token,
                'created_at' => Carbon::now(),
            ]);

            Mail::to($data['email'])
                ->queue(new PasswordResetMail($token));
        }
    }
    
}
