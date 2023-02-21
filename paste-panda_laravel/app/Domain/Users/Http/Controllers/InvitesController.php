<?php

namespace App\Domain\Users\Http\Controllers;

use App\Domain\Users\Actions\RegisterUser;
use App\Domain\Users\Http\Requests\CreateInvitationRequest;
use App\Domain\Users\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Junaidnasir\Larainvite\Facades\Invite;
use Junaidnasir\Larainvite\Models\LaraInviteModel;

class InvitesController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
	    if (Request()->user()->cannot('create', LaraInviteModel::class)) {
		    abort(403);
	    }

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
    public function store(CreateInvitationRequest $request)
    {
	    if ($request->user()->cannot('create', LaraInviteModel::class)) {
		    abort(403);
	    }
	    
	    Invite::invite($request->email, Auth::user()->id);

        return redirect()->back()
            ->with('success', 'User was successfully invited and an email has been sent.');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Inertia\Response
     */
    public function show($id)
    {
        $invite = Invite::get($id);

        Inertia::setRootView('guest');

        return Inertia::render('Guest/Invite', [
            'invite' => $invite,
        ]);
    }
}
