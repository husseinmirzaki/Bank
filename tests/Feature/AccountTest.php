<?php

namespace Tests\Feature;

use App\Account;
use Tests\TestCase;

class AccountTest extends TestCase
{
    use TestTrait;

    /** @test */
    public function logged_in_can_create_an_account()
    {
        $this->login();
        $this->response = $this->post('account', [
            'identification' => random_int(10000000, 90000000) . random_int(10000000, 90000000),
            'user_id'        => $this->user()->id,
            'type'           => random_int(10, 200)
        ]);

        $this->assertFalse(Account::all()->isEmpty());
    }

    /** @test */
    public function logged_in_can_update_an_account()
    {
        $this->user();
        $user = $this->user();
        $account = $this->account();
        $this->login();
        $data = ['1', 2];

        $this->response = $this->patch("account/{$account->id}", [
            'identification' => '1234567812345678',
            'user_id'        => $user->id,
            'data'           => $data,
            'type'           => 150
        ]);

        $this->assertSame('1234567812345678', Account::find($account->id)->identification);
        $this->assertSame("$user->id", Account::find($account->id)->user_id);
        $this->assertSame($data, Account::find($account->id)->data);
        $this->assertSame('150', Account::find($account->id)->type);
    }

    /** @test */
    public function super_admin_can_delete_an_account()
    {
        $user = $this->user();
        $account = $this->account();
        $this->login(110);
        $this->response = $this->delete("account/{$account->id}");
        $this->assertSame(null, Account::find($account->id));
    }

    /** @test */
    public function owner_can_delete_an_account()
    {
        $user = $this->user();
        $account = $this->account();
        $this->login($user);
        $this->response = $this->delete("account/{$account->id}");
        $this->assertSame(null, Account::find($account->id));
    }
}
