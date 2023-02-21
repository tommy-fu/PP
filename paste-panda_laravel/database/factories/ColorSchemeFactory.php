<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Domain\ColorThemes\ColorScheme;
use App\Domain\ColorThemes\ColorSchemeSet;
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

$factory->define(ColorScheme::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
	    'colors' => json_decode('{"background":"#FFFFFF","primary":"#1A94FF","secondary":"#FFD301","tertiary":"#E07200","quaternary":"#975CB6","success":"#0082CA","danger":"#7D3333","warning":"#372B2B","info":"#A25959","grey":"#C28686","dark":"#262626","light":"#922D2D", "link": "#000"}', true),
	    'order_column' => 1,
	    'color_scheme_set_id' => function(){
    	return Factory(ColorSchemeSet::class)->create()->id;
	    }
    ];
});
