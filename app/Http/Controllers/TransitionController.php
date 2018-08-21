<?php

namespace App\Http\Controllers;

use App\Transition;
use Illuminate\Http\Request;

class TransitionController extends Controller
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
            'mount'   => 'required|numeric',
            'user_id' => 'required|numeric|exists:users,id',
            'bank_id' => 'required|numeric|exists:banks,id',
            'start_bank_id' => 'numeric|exists:banks,id',
            'type'   => 'numeric|max:200'
        ];
        $this->validate($request, $rules);

        Transition::create($request->only(array_keys($rules)));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transition $transition
     *
     * @return void
     */
    public function show(Transition $transition)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transition $transition
     *
     * @return void
     */
    public function edit(Transition $transition)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Transition          $transition
     *
     * @return void
     */
    public function update(Request $request, Transition $transition)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transition $transition
     *
     * @return void
     */
    public function destroy(Transition $transition)
    {
        //
    }
}
