<?php

use Faker\Generator as Faker;

$factory->define(App\Bank::class, function (Faker $faker) {
    $user = \App\User::all(['id'])->toArray();
    return [
        'name' => $faker->name,
        'description' => $faker->text(250),
        'hash' => $faker->text(200),
        'user_id' => $faker->randomElement($user)['id'],
    ];
});
