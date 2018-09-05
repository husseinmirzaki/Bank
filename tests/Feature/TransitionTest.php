<?php

namespace Tests\Feature;

use App\Transition;
use Tests\TestCase;


class TransitionTest extends TestCase
{
    use TestTrait;


    /** @test */
    public function logged_in_can_create_a_transition()
    {
        $this->login();
        $this->response = $this->post('transition', [
            'mount'         => random_int(1000000, 9000000),
            'type'          => random_int(10, 200),
            'user_id'       => $this->user()->id,
            'bank_id'       => $this->bank()->id,
            'start_bank_id' => $this->bank()->id,
        ]);

        $this->assertFalse(Transition::all()->isEmpty());

    }

    /** @test */
    public function logged_in_can_update_a_transition()
    {
        $user = $this->user(5);
        $bank = $this->bank(5);
        $transtion = $this->transition();
        $this->login();

        $this->response = $this->patch("transition/{$transtion->id}", [
            'mount'         => '123456789',
            'type'          => 150,
            'user_id'       => $user[4]->id,
            'bank_id'       => $bank[4]->id,
            'start_bank_id' => $bank[3]->id
        ]);

        $this->assertSame('123456789', Transition::find($transtion->id)->mount);
        $this->assertSame($user[4]->id . "", Transition::find($transtion->id)->user_id);
        $this->assertSame("150", Transition::find($transtion->id)->type);
        $this->assertSame($bank[4]->id . "", Transition::find($transtion->id)->bank_id);
        $this->assertSame($bank[3]->id . "", Transition::find($transtion->id)->start_bank_id);
    }

    /** @test */
    public function super_admin_can_delete_a_transition()
    {
        $user = $this->user();
        $bank = $this->bank();
        $transition = $this->transition();
        $this->login(110);
        $this->response = $this->delete("transition/{$transition->id}");
        $this->assertSame(null, Transition::find($transition->id));
    }

    /** @test */
    public function owner_can_delete_a_transition()
    {
        $user = $this->user();
        $bank = $this->bank();
        $transition = $this->transition();
        $this->login($user);
        $this->response = $this->delete("transition/{$transition->id}");
        $this->assertSame(null, Transition::find($transition->id));
    }
}
