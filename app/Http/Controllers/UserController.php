<?php

namespace App\Http\Controllers;

use App\Events\EmailChangedEvent;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\MessageBag;

class UserController extends Controller
{
    use ControllersTrait;



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return $this->getCreateView(User::class, 'models.user', null, 'user');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name'     => 'required|string|max:255',
            'family'   => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'level'    => 'numeric',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ];
        $this->validate($request, $rules);

        $data = $request->only(array_keys($rules));
        $data['password'] = Hash::make($data['password']);

        User::create($data);

        return back()->withErrors(new MessageBag([
            'success' => [
                'added successfully'
            ]
        ]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(User $user)
    {
        return $this->getEditView($user, User::class, 'user');
    }

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

        return back()->withErrors(new MessageBag([
            'success' => 'updated successfuly'
        ]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     *
     * @return Response
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        if (Auth::user()->can('delete', $user)) {
            $user->delete();
            return back()->withErrors(new MessageBag([
                'success' => [
                    'Deleted User Successfuly'
                ]
            ]));
        }

        return back()->withErrors(new MessageBag([
            [
                __('You are not allowed to delete this element')
            ]
        ]));
    }
}
