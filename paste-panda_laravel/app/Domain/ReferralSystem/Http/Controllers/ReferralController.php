<?php

namespace App\Domain\ReferralSystem\Http\Controllers;

use App\Domain\ReferralSystem\Models\ReferralReward;
use App\Domain\Users\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class ReferralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::where('affiliate_id', $request->affiliate_id)->first();

        $user = User::create([
            'name' => $request->first_name . ' ' . $request->last_name,
            'password' => bcrypt($request->password),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'referred_by' => $user->id,
        ]);

        return redirect()->to('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($ref)
    {
        return view('referral.show', [
            'affiliate_id' => $ref,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function downloadReward($id)
    {
        $reward = ReferralReward::findOrFail($id);

        if (Auth::user()->verified_referrals()->count() < $reward->referrals_needed) {
            return response('Unauthenticated.', 401);
        }

        $file = $reward->getMedia('zip')->first()->getPath();

        $headers = [
            'Content-Type: application/zip',
        ];

        return Response::download($file, 'reward.zip', $headers);
    }
}
