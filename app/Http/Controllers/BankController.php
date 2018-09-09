<?php /** @noinspection ALL */

namespace App\Http\Controllers;

use App\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;

class BankController extends Controller
{

    use ControllersTrait;

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
        return $this->getCreateView(Bank::class , 'models.bank' , null , 'bank');
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
        ];
        $this->validate($request, $rules);

        $data = $request->only(array_keys($rules));
        $data['hash'] = str_random(200);
        $data['user_id'] = Auth::user()->id;

        Bank::create($data);

        return back()->withErrors(new MessageBag([
            'success' => [
                'added successfully'
            ]
        ]));
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
        return $this->getEditView($bank, Bank::class,  'bank');
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
        $rules = [
            'name'        => 'string|max:255',
            'description' => 'string|max:255',
            'user_id'     => 'numeric|exists:users,id',
            'hash'        => 'string|max:200',
        ];
        $this->validate($request, $rules);

        $bank->update($request->only(array_keys($rules)));

        return back()->withErrors(new MessageBag([
            'success' => 'updated successfuly'
        ]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bank $bank
     *
     * @return void
     * @throws \Exception
     */
    public function destroy(Bank $bank)
    {
        if (Auth::user()->can('delete', $bank)) {
            $bank->delete();
            return back()->withErrors(new MessageBag([
                'success' => [
                    'Deleted Bank Successfuly'
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
