<?php

namespace App\Domain\Users\Actions;

use App\Domain\Users\User;

class RegisterUser
{
    public function execute($data)
    {
        return User::create([
            'name' => $data['first_name'] . ' ' . $data['last_name'],
            'password' => bcrypt($data['password']),
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
        ]);
    }
}
