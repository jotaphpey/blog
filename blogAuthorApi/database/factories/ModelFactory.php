<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Author::class, function (Faker\Generator $faker) {
    return [
        'username' => $faker->name(),
        'bio' => $faker->sentence,
        'image' => $faker->imageUrl(640,480),
        'following' => $faker->boolean,
    ];
});
