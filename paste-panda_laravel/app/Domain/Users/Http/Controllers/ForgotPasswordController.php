<?php

namespace App\Domain\Users\Http\Controllers;

use App\Domain\Authentication\Actions\RequestPasswordReset;
use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotPasswordRequest;
use Illuminate\Support\Facades\Session;

class ForgotPasswordController extends Controller
{
    public function index()
    {
        return view('users.forgot_password');
    }

    public function store(ForgotPasswordRequest $request, RequestPasswordReset $requestPasswordReset)
    {
        $requestPasswordReset->execute($request->all());

        Session::flash('notification', 'If the provided email exists, a mail with instructions will be sent to that email.');

        return redirect()->route('users.show_login')->with([
            'notification' => 'If the provided email exists, a mail with instructions will be sent to that email.',
        ]);
    }
}
