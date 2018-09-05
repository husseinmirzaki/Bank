<?php

namespace App\Http\Controllers;

use App\Events\EmailChangedEvent;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param User                      $user
     *
     * @return void
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'name'     => 'string|max:255',
            'family'   => 'string|max:255',
            'level'    => 'numeric',
            'username' => 'string|max:255|unique:users',
            'email'    => 'string|email|max:255|unique:users',
        ];
        $this->validate($request, $rules);

        $user->update($data = $request->only(array_keys($rules)));

        if (array_has($data, 'email')) {
            //            event(new EmailChangedEvent($user));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     *
     * @return void
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        $user->delete();
    }
}
