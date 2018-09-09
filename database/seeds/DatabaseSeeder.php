<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        \Illuminate\Support\Facades\Artisan::call('migrate:fresh');
        $user = \App\User::create([
            'name'     => 'Seyed Hussein',
            'family'   => 'Mirzaki',
            'level'    => '999',
            'username' => 'husseinmirzaki',
            'email'    => 'husseinmirzaki@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('123456')
        ]);

        $bank = \App\Bank::create([
            'name'        => 'Melli',
            'description' => 'This is melli bank',
            'hash'        => str_random(200),
            'user_id'     => $user->id
        ]);

        $bank1 = \App\Bank::create([
            'name'        => 'Melat',
            'description' => 'This is Melat bank',
            'hash'        => str_random(200),
            'user_id'     => $user->id
        ]);

        $account = \App\Account::create([
            'user_id'        => $user->id,
            'bank_id'        => $bank->id,
            'identification' => str_random(16),
            'type'           => 1
        ]);
        $account1 = \App\Account::create([
            'user_id'        => $user->id,
            'bank_id'        => $bank->id,
            'identification' => str_random(16),
            'type'           => 2
        ]);
        $account2 = \App\Account::create([
            'user_id'        => $user->id,
            'bank_id'        => $bank->id,
            'identification' => str_random(16),
            'type'           => 3
        ]);
        $account3 = \App\Account::create([
            'user_id'        => $user->id,
            'bank_id'        => $bank1->id,
            'identification' => str_random(16),
            'type'           => 4
        ]);

        // $this->call(UsersTableSeeder::class);
    }
}
