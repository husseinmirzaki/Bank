<?php /** @noinspection ALL */

namespace App\Http\Controllers;

use App\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;

class AccountController extends Controller
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
        return $this->getCreateView(Account::class, 'models.account', null, 'account');
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
        /*$rules = [
            'identification' => 'required|string|min:16|max:17',
            'type'           => 'required|numeric|max:200',
            'data'           => 'JSON',
        ];*/
        $rules = [
            'type'    => 'required|numeric',
            'bank_id' => 'required|numeric|exists:banks,id'
        ];
        $this->validate($request, $rules);

        $data = $request->only(array_keys($rules));

        if (!Account::where('user_id', Auth::user()->id)->where('bank_id', $data['bank_id'])->where('type', $data['type'])->get()->isEmpty()) {
            return back()->withErrors(new MessageBag([
                'You already have an account of that type in that bank !!'
            ]));
        }
        $data['user_id'] = Auth::user()->id;
        $data['identification'] = str_random(16);


        Account::create($data);


        return back()->withErrors(new MessageBag([
            'success' => [
                "added successfully {$data['identification']}"
            ]
        ]));
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
        return $this->getEditView($account, Account::class,  'account');
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
        $rules = [
            'identification' => 'string|max:17|min:16',
            'user_id'        => 'numeric|exists:users,id',
            'type'           => 'numeric',
            'bank_id'        => 'numeric',
        ];

        $this->validate($request, $rules);


        $account->update($request->only(array_keys($rules)));

        return back()->withErrors(new MessageBag([
            'success' => 'updated successfuly'
        ]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Account $account
     *
     * @return void
     * @throws \Exception
     */
    public function destroy(Account $account)
    {
        if (Auth::user()->can('delete', $account)) {
            $account->delete();
            return back()->withErrors(new MessageBag([
                'success' => [
                    'Deleted Account Successfuly'
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
