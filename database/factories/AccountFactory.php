<?php

use Faker\Generator as Faker;

$factory->define(App\Account::class, function (Faker $faker) {
    $user = \App\User::all(['id'])->toArray();
    return [
        'identification'=>$faker->randomNumber(8).$faker->randomNumber(8),
        'user_id' => $faker->randomElement($user)['id'],
        'data' => json_encode(['some random data !!!']),
    ];
});
