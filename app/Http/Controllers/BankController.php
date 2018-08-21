<?php /** @noinspection ALL */

namespace App\Http\Controllers;

use App\Bank;
use Illuminate\Http\Request;

class BankController extends Controller
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
            'name'        => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'user_id'     => 'required|numeric|exists:users,id',
        ];
        $this->validate($request, $rules);

        Bank::create($request->only(array_keys($rules)));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bank $bank
     *
     * @return void
     */
    public function show(Bank $bank)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bank $bank
     *
     * @return void
     */
    public function edit(Bank $bank)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Bank                $bank
     *
     * @return void
     */
    public function update(Request $request, Bank $bank)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bank $bank
     *
     * @return void
     */
    public function destroy(Bank $bank)
    {
        //
    }
}
