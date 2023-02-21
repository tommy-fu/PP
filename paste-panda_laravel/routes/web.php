<?php

use App\Domain\Onboarding\Http\Controllers\OnboardingSurveyController;
use App\Domain\Users\Http\Controllers\UserBrandsController;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\OnboardingMiddleware;
use App\Survey;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;

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

//Auth::routes();

Route::get('/signin/', [
    'uses' => '\App\Domain\Users\Http\Controllers\LoginController@show',
    'as' => 'users.show_login',
]);

Route::get('/terms', function () {
    return view('terms');
})->name('terms');

Route::get('/privacy', function () {
	return view('privacy');
})->name('privacy');


Route::get('/register/', [
    'uses' => '\App\Domain\Users\Http\Controllers\RegisterController@show',
    'as' => 'users.sign_up',
]);

Route::post('/register/', [
    'uses' => '\App\Domain\Users\Http\Controllers\RegisterController@post',
    'as' => 'users.register',
]);

Route::resource('forgot-password', '\App\Domain\Users\Http\Controllers\ForgotPasswordController');
Route::resource('reset-password', '\App\Domain\Users\Http\Controllers\ResetPasswordController');

Route::post('/authenticate/', [
    'uses' => '\App\Domain\Users\Http\Controllers\LoginController@post',
    'as' => 'users.sign_in',
]);

Route::get('/logout/', [
    'uses' => '\App\Domain\Users\Http\Controllers\LogoutController@show',
    'as' => 'users.sign_out',
]);

Route::post('/settings/update-password', [
    'uses' => '\App\Domain\Users\Http\Controllers\AccountController@updatePassword',
    'as' => 'account.update_password',
]);

Route::post('/settings/update', [
    'uses' => '\App\Domain\Users\Http\Controllers\AccountController@update',
    'as' => 'account.update',
]);

Route::group(['middleware' => [Authenticate::class, OnboardingMiddleware::class]], function () {
    Route::get('/', function () {
        return redirect()->to('/sections');
    });

    Route::resource('/scheme-color-formula', 'SchemeColorFormulaController');

    Route::get('/settings', [
        'uses' => '\App\Domain\Users\Http\Controllers\AccountController@edit',
        'as' => 'accounts.edit',
    ]);

    Route::get('/sections/temp', [
        'uses' => '\App\Domain\Sections\Http\Controllers\SectionsController@getLibraryPage',
    ])->name('sections-library.show');

    Route::put('/brands/{brand}/', [
        'uses' => '\App\Domain\Brand\Http\Controllers\BrandsController@update',
    ]);

    Route::get('/sections/{id}/duplicate', [\App\Domain\Sections\Http\Controllers\SectionsController::class, 'duplicate']);

    Route::resource('/user-brands', '\App\Domain\Users\Http\Controllers\UserBrandsController');
    Route::get('/user-brands-library', [UserBrandsController::class, 'getLibrary']);
    Route::resource('/user-programming-languages', '\App\Domain\Users\Http\Controllers\UserProgrammingLanguagesController');
    Route::resource('/user-color-schemes', '\App\Domain\Users\Http\Controllers\UserColorSchemesController');
    Route::resource('/color-schemes', '\App\Domain\ColorThemes\Http\Controllers\ColorSchemesController');
    Route::resource('/styles', '\App\Domain\Brand\Http\Controllers\BrandsController');
    Route::resource('/sections', '\App\Domain\Sections\Http\Controllers\SectionsController');
	Route::resource('/fragments', '\App\Http\Controllers\FragmentsController');
    Route::resource('/admin/sections', 'AdminSectionsController');
    Route::resource('/admin/fragments', 'AdminFragmentsController');

    Route::resource('/survey', '\App\Http\Controllers\SurveyController');

    Route::put('/color-schemes/{id}/cards/inherit', [\App\Domain\ColorThemes\Http\Controllers\ColorSchemesController::class, 'cardInherit']);

    Route::resource('/invites', '\App\Domain\Users\Http\Controllers\InvitesController', ['except' => ['show', 'delete', 'index']]);

    Route::patch('/user-onboarding', [\App\Http\Controllers\UserShowOnboardingController::class, 'update'])->name('users.show_onboarding.update');

    Route::post('/feedback', function () {
        \App\Services\ElasticService::addToElastic('SurveySubmitted', Request()->answers);

        Survey::create([
            'json' => Request()->answers,
            'user_id' => Auth::user()->id,
        ]);

        Auth::user()->update([
            'survey_answered' => 1,
        ]);

        return redirect()->back();
    });

//    Route::resource('/color-schemes-generator', 'ColorSchemeGeneratorController');
});

Route::post('/invites/accept/', [\App\Domain\Users\Http\Controllers\AcceptInvitationController::class, 'store'])
	->name('accept_invites.store');

Route::resource('/invites', '\App\Domain\Users\Http\Controllers\InvitesController', ['except' => ['store', 'delete', 'create']]);

Route::group(['middleware' => [Authenticate::class]], function () {
	
    Route::post('/api/html', [\App\Http\Controllers\CopyCodeController::class, 'show']);
    
    Route::get('/onboarding', [OnboardingSurveyController::class, 'show'])->name('users.show_onboarding');

    Route::post('/onboarding', [OnboardingSurveyController::class, 'store'])->name('onboarding_survey.store');
});

Route::get('/js/{id}', function ($id) {
    \App\JavaScriptModule::initializeSingleton();
    $section = \App\Domain\Sections\Models\Section::findOrFail($id);

    $response = Response::make($section->js->wrappedCode(), 200);
    $response->header('Content-Type', 'text/javascript');

    return $response;
});

Route::get('/css/{id}', [\App\Http\Controllers\SectionCssController::class, 'show']);

Route::get('my-section/{id}', function ($id) {
    return \App\Domain\Sections\Models\Section::findOrFail($id);
});

//Route::get('/my-sections', function (Request $request, \App\Domain\Sections\Actions\GetSectionsAction $getSectionsAction) {
//    return $getSectionsAction->execute();
//});

Route::get('/webflow-convert', [\App\Http\Controllers\WebflowAnimationsController::class, 'show']);


Route::get('/home', function () {
	return view('home');
});


//Route::resource('/pages', 'App\Domain\PageBuilder\Http\Controllers\PagesController');
Route::get('/pages/{page}', [\App\Domain\PageBuilder\Http\Controllers\PagesController::class, 'show']);

Route::resource('/request-access', 'RequestAccessController');

Route::get('/signup/success', function () {
	return view('Guest/signup_success');
});
