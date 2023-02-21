<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Inertia\Inertia;

use App\Notifications\NewSubscriber;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;
use Illuminate\Support\Facades\Notification;
use Spatie\Newsletter\NewsletterFacade as Newsletter;

class NewsletterController extends Controller
{
    public function post(Request $request)
    {
        $email = $request->input('signup');
        // if(!$email) {
        //     $response = ['emailFail' => true];
        //     return response()->json($response);
        // }
        $data = [
            'email' => $email,
            'url' => $_SERVER['REQUEST_URI']
        ];
        $validator = Validator::make($request->all(), [
            'signup' => 'required|email:rfc,dns'
        ]);
        if (!$email || $validator->fails()) {
            $response = ['emailFail' => true];
            return response()->json($response);
        } else {
            $getMember = Newsletter::getMember($email);
            if ($getMember['status'] != 'subscribed') {
                Newsletter::subscribe($email);
                Notification::route('slack', env('SLACK_NOTIFICATION_WEBHOOK'))->notify(new NewSubscriber($email));
                \App\Services\ElasticService::addToElastic('subscribe', $data);
                return ['redirect' => route('newsletter.get')];
            }
        }
    }
}
