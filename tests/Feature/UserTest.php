<?php /** @noinspection ALL */

namespace Tests\Feature;


use Illuminate\Support\Facades\Auth;
use Tests\TestCase;


class UserTest extends TestCase
{
    use TestTrait;

    /** @test */
    public function anyone_can_create_a_user()
    {
        $this->response  = $this->post('register', [
            'name'                  => 'سید حسین',
            'family'                => 'میرزکی',
            'email'                 => 'husseinmirzaki.ir@gmail.com',
            'username'              => 'husseinmirzaki.ir',
            'password'              => '123456',
            'password_confirmation' => '123456'
        ]);

        $this->assertTrue(Auth::check());

    }
}
