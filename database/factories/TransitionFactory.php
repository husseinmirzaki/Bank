<?php

use Faker\Generator as Faker;

$factory->define(App\Transition::class, function (Faker $faker) {
    $user = \App\User::all(['id'])->toArray();
    $bank = \App\Bank::all(['id'])->toArray();
    return [
        'mount' => $faker->randomNumber(8),
        'type' => $faker->randomNumber(1),
        'user_id' => $faker->randomElement($user)['id'],
        'bank_id' => $faker->randomElement($bank)['id'],
        'start_bank_id' => $faker->randomElement($bank)['id'],
    ];
});
