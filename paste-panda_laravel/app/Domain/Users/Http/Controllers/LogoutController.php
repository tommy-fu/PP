<?php

namespace App\Domain\Users\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\ElasticService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
	public function show(){
		
		ElasticService::addToElastic('Logout', [
			'session_end' => Carbon::now()->toDateTimeString(),
		]);
		
		Auth::logout();
		
		return redirect()->to('/');
    }
}
