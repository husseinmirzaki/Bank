<?php

namespace App\Http\Controllers;

use App\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return void
     */
    public function store(Request $request)
    {

        $rules = [
            'identification' => 'required|string|min:16|max:17',
            'user_id'        => 'required|numeric|exists:users,id',
            'type'           => 'required|numeric|max:200',
            'data'           => 'JSON',
        ];
        $this->validate($request, $rules);

        Account::create($request->only(array_keys($rules)));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Account $account
     *
     * @return void
     */
    public function show(Account $account)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Account $account
     *
     * @return void
     */
    public function edit(Account $account)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Account             $account
     *
     * @return void
     */
    public function update(Request $request, Account $account)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Account $account
     *
     * @return void
     */
    public function destroy(Account $account)
    {
        //
    }
}
