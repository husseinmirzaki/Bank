<?php /** @noinspection ALL */

namespace Tests\Feature;

use App\Bank;
use Tests\TestCase;


class BankTest extends TestCase
{
    use TestTrait;

    /** @test */
    public function anyone_can_create_a_bank()
    {

        $this->login();
        $this->response  = $this->post('bank', [
            'user_id' => $this->user()->id,
            'description' => 'Test description',
            'name' => 'Test Name'
        ]);

        $this->assertFalse(Bank::all()->isEmpty());
    }
}
