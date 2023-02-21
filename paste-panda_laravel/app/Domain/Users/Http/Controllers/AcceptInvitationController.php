<?php

namespace App\Domain\Users\Http\Controllers;

use App\Domain\Brand\Models\Brand;
use App\Domain\ColorThemes\ColorSchemeSet;
use App\Domain\Users\Actions\RegisterUser;
use App\Domain\Users\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterFormRequest;
use App\Notifications\BetaUserJoinedNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Inertia\Inertia;
use Junaidnasir\Larainvite\Facades\Invite;

class AcceptInvitationController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        //
        //	    Invite::invite('vi.man93@gmail.com', User::first()->id);

        Inertia::setRootView('guest');

        return Inertia::render('Guest/CreateInvite', [
//		    'invite' => $invite,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param RegisterUser $registerUser
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(RegisterFormRequest $request)
    {
        $code = $request->code;

        if (Invite::isAllowed($code, $request->email)) {
            $data = $request->all();

            $theme = ColorSchemeSet::first();

//            $scheme = $theme->colorSchemes()->ordered()->first();
            $scheme = $theme->colorSchemes()->ordered()->first();

            $user = User::create([
                'name' => $data['first_name'] . ' ' . $data['last_name'],
                'password' => bcrypt($data['password']),
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'brand_id' => Brand::first()->id,
                'color_scheme_set_id' => $scheme->color_scheme_set_id,
                'color_scheme_id' => $scheme->id,
            ]);

            Invite::consume($code);

            Notification::route('slack', env('SLACK_HOOK_BETA'))
                ->notify(new BetaUserJoinedNotification($user));

            Auth::loginUsingId($user->id);

            return redirect()->to('/');
        }

        return redirect()->back()
            ->withErrors(['code' => 'This code has already been used.']);
    }
}
