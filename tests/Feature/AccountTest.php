<?php

namespace Tests\Feature;

use App\Account;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class AccountTest extends TestCase
{
    use TestTrait;

    /** @test */
    public function anyone_can_create_an_account()
    {
        $this->login();
        $this->response = $this->post('account', [
            'identification' => random_int(10000000,90000000) . random_int(10000000,90000000),
            'user_id' => $this->user()->id,
            'type' => random_int(10,200)
        ]);

        $this->assertFalse(Account::all()->isEmpty());
    }
}
