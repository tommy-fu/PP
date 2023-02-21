<?php

use App\Models\Kit;
use Inertia\Inertia;
use App\Notifications\NewPurchase;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Notification;
use Spatie\Newsletter\NewsletterFacade as Newsletter;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $data = [
        'url' => $_SERVER['REQUEST_URI'],
    ];
    $kits = \App\Models\Kit::with('tags')
        ->get();
    \App\Services\ElasticService::addToElastic('initial',$data);
    return view('welcome', [
        'kits' => $kits
    ]);
});

Route::post('/purchase', function () {
    $request = json_encode(request()->all());
    $data = json_decode($request);
    $getMember = Newsletter::getMember(request()->email);

    if ($getMember['status'] != 'subscribed') {

        Newsletter::subscribe(request()->email);
    }

    Notification::route('slack', env('SLACK_NOTIFICATION_WEBHOOK'))->notify(new NewPurchase($data));

    \App\Services\ElasticService::ping(json_encode(request()->all()), 'kitshop-marketing-test/_doc');
});

Route::get('/home', function () {
    // Inertia::setRootView('app');
    $data = [
        'url' => $_SERVER['REQUEST_URI'],
    ];
    $kits = \App\Models\Kit::with('tags')
        ->get();
    
    \App\Services\ElasticService::addToElastic('initial',$data);

    return view('homed', [
        'kits' => $kits
    ]);
});

Route::get('/buy', [
    'uses' => 'App\Http\Controllers\MarketingController@buy',
    'as' => ('marketing.buy')
]);

Route::get('/preview', [
    'uses' => 'App\Http\Controllers\MarketingController@preview',
    'as' => ('marketing.preview')
]);

Route::post('/newsletter', [
    'uses' => 'App\Http\Controllers\NewsletterController@post',
    'as' => ('newsletter.post')
]);

Route::get('/newsletter', function(){
    return view('newsletter');
})->name('newsletter.get');

Route::get('/privacy', function () {

    return view('privacy');
});

Route::get('/terms', function () {

    return view('terms');
});

Route::get('/test', function () {

    $kit = Kit::where('name','Billaby')->get();
    // dd($kit);r
    foreach($kit as $k) {
    echo $k->getFirstMediaUrl('thumbnail');
    }
});

Route::get('about', function () {
    return view('about-us');
});