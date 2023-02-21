<?php

Route::post('/settings/update-password', [
	'uses' => '\App\Domain\Users\Http\Controllers\AccountController@updatePassword',
	'as' => 'account.update_password',
]);

Route::post('/settings/update', [
	'uses' => '\App\Domain\Users\Http\Controllers\AccountController@update',
	'as' => 'account.update',
]);
