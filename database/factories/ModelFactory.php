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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt('password'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Category::class, function (Faker\Generator $faker) {
    return [
        'name' => implode(' ', $faker->words(2)),
        'description' => $faker->sentence(),
    ];
});

$factory->define(App\Topic::class, function (Faker\Generator $faker) {
    return [
        'category_id' => null,
        'user_id' => 1,
        'title' => $faker->sentence,
        'body' => $faker->paragraph(7),
        'views' => $faker->numberBetween(0, 10000),
        'created_at' => $faker->datetimeBetween('-5 months'),
    ];
});

$factory->define(App\Comment::class, function (Faker\Generator $faker) {
    return [
        'topic_id' => 1,
        'user_id' => 1,
        'body' => $faker->sentence,
    ];
});

