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

$factory->define(App\Article::class, function (Faker\Generator $faker) {
    $title = $faker->sentence(3, true);
    $slug = str_replace(" ", "-", strtolower($title));
    return [
        'title' => $title,
        'slug' => $slug,
        'description' => $faker->sentence(10, true),
        'body' => $faker->randomHtml(2, 3),
        'tagList' => implode(",", $faker->words(3)),
        'favorited' => $faker->boolean(),
        'favoritesCount' => $faker->numberBetween(0,10000),
        'author_id' => $faker->numberBetween(1,150),
    ];
});