<?php

namespace Tests\Feature;

use App\Transition;
use Tests\TestCase;


class TransitionTest extends TestCase
{
    use TestTrait;


    /** @test */
    public function anyone_can_create_a_transition()
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
}
