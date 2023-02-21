<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(\App\Domain\ColorThemes\ColorSchemeSet::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
//	    'colors' => json_decode('{"background":"#FFFFFF","primary":"#1A94FF","secondary":"#FFD301","tertiary":"#E07200","quaternary":"#975CB6","success":"#0082CA","danger":"#7D3333","warning":"#372B2B","info":"#A25959","grey":"#C28686","dark":"#262626","light":"#922D2D"}', true)
    ];
});
