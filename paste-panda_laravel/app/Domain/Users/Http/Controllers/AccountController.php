<?php

namespace App\Domain\Users\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAccountSettingsRequest;
use App\Http\Requests\UpdatePasswordRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class AccountController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Inertia\Response
     */
    public function edit()
    {
        $user = \Auth::user();

        return Inertia::render('Account');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAccountSettingsRequest $request)
    {
        $user = Auth::user();

        Session::flash('account_updated', 'Your account settings has been updated.');

        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
        ]);

        return redirect()->back();
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $user = Auth::user();

        if (!\Hash::check($request->current_password, $user->password)) {
            return redirect()->back()
                ->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        $user->update([
            'password' => bcrypt($request->password),
        ]);

        Session::flash('password_updated', 'Your password has been updated.');

        return redirect()->back();
    }
}
