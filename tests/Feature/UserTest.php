<?php /** @noinspection ALL */

namespace Tests\Feature;


use App\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;


class UserTest extends TestCase
{
    use TestTrait;

    /** @test */
    public function logged_in_can_create_a_user()
    {
        $this->response = $this->post('register', [
            'name'                  => 'سید حسین',
            'family'                => 'میرزکی',
            'email'                 => 'husseinmirzaki.ir@gmail.com',
            'username'              => 'husseinmirzaki.ir',
            'password'              => '123456',
            'password_confirmation' => '123456'
        ]);

        $this->assertTrue(Auth::check());

    }

    /** @test */
    public function logged_in_can_update_a_user()
    {
        $user = $this->user();
        $this->login();

        $this->response = $this->patch("user/{$user->id}", [
            'name'     => 'test name',
            'family'   => 'test family',
            'level'    => 20,
            'email'    => 'husseinmirzaki@gmail.com',
            'username' => 'husseinimrzaki'
        ]);

        $this->assertSame('test name', User::find($user->id)->name);
        $this->assertSame('test family', User::find($user->id)->family);
        $this->assertSame("20", User::find($user->id)->level);
        $this->assertSame('husseinmirzaki@gmail.com', User::find($user->id)->email);
        $this->assertSame('husseinimrzaki', User::find($user->id)->username);
    }

    /** @test */
    public function super_admin_can_delete_a_user()
    {
        $user = $this->user();
        $this->login(110);
        $this->response = $this->delete("user/{$user->id}");
        $this->assertSame(null, User::find($user->id));
    }

    /** @test */
    public function owner_can_delete_a_user()
    {
        $user = $this->user();
        $this->login($user);
        $this->response = $this->delete("user/{$user->id}");
        $this->assertSame(null, User::find($user->id));
    }
}
