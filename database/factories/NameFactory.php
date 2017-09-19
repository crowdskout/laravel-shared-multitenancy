<?php

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

$factory->define(App\Name::class, function (Faker $faker) {
    return [
        'first' => $faker->firstName,
        'last' => $faker->lastName,
        'profile_id' => function () {
            return factory(App\Profile::class)->create()->id;
        }
    ];
});
