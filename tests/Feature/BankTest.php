<?php /** @noinspection ALL */

namespace Tests\Feature;

use App\Bank;
use Tests\TestCase;


class BankTest extends TestCase
{
    use TestTrait;

    /** @test */
    public function logged_in_can_create_a_bank()
    {

        $this->login();
        $this->response = $this->post('bank', [
            'user_id'     => $this->user()->id,
            'description' => 'Test description',
            'name'        => 'Test Name'
        ]);

        $this->assertFalse(Bank::all()->isEmpty());
    }

    /** @test */
    public function logged_in_can_update_a_bank()
    {
        $this->user();
        $user = $this->user();
        $bank = $this->bank();
        $this->login();

        $this->response = $this->patch("bank/{$bank->id}", [
            'name'        => 'test name',
            'description' => 'test description',
            'hash'        => 'test hash',
            'user_id'     => $user->id,
        ]);

        $this->assertSame('test name', Bank::find($bank->id)->name);
        $this->assertSame('test description', Bank::find($bank->id)->description);
        $this->assertSame('test hash', Bank::find($bank->id)->hash);
        $this->assertSame("$user->id", Bank::find($bank->id)->user_id);
    }


    /** @test */
    public function super_admin_can_delete_a_bank()
    {
        $user = $this->user();
        $bank = $this->bank();
        $this->login(110);
        $this->response = $this->delete("bank/{$bank->id}");
        $this->assertSame(null, Bank::find($bank->id));
    }

    /** @test */
    public function owner_can_delete_a_bank()
    {
        $user = $this->user();
        $bank = $this->bank();
        $this->login($user);
        $this->response = $this->delete("bank/{$bank->id}");
        $this->assertSame(null, Bank::find($bank->id));
    }
}

