<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('sections.{id}', function ($section, $id) {
	return true;
	return \App\Domain\Users\User::findOrFail($id)->isAdmin();
});


Broadcast::channel('fragments.{id}', function ($fragment, $id) {
	return true;
	return \App\Domain\Users\User::findOrFail($id)->isAdmin();
});
