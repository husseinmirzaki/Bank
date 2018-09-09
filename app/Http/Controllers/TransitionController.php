<?php /** @noinspection ALL */

namespace App\Http\Controllers;

use App\Transition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;

class TransitionController extends Controller
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
    public function createDeposit()
    {
        return $this->getCreateView('App\Transition', 'models.transitionDeposit', function ($table) {
            return Transition::where('type', 1);
        }, 'transition');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function createWithdraw()
    {
        return $this->getCreateView('App\Transition', 'models.transitionWithdraw', function ($table) {
            return Transition::where('type', 2);
        }, 'transition');
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
            'type' => 'required',
        ];
        $this->validate($request, $rules);


        if ($request->get('type') == 1) {
            $rules = [
                'mount'           => 'required|numeric',
                'to_bank_id'      => 'required|numeric|exists:banks,id',
                'from_bank_id'    => 'required|numeric|exists:banks,id',
                'from_account_id' => 'required|numeric|exists:accounts,id',
                'to_account_id'   => 'required|numeric|exists:accounts,id',
                'type'            => 'required',
            ];
            $this->validate($request, $rules);

        } elseif ($request->get('type') == 2) {

            $rules = [
                'mount'           => 'required|numeric',
                'from_bank_id'    => 'required|numeric|exists:banks,id',
                'from_account_id' => 'required|numeric|exists:accounts,id',
                'type'            => 'required',
            ];
            $this->validate($request, $rules);
        }
        $data = $request->only(array_keys($rules));
        $data['user_id'] = Auth::user()->id;

        Transition::create($data);

        return back()->withErrors(new MessageBag([
            'success' => [
                'added successfuly'
            ]
        ]));
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
        if ($transition->type == 1)
            return $this->getEditView($transition, Transition::class, 'transition', 'transition.createDeposit');
        return $this->getEditView($transition, Transition::class, 'transition', 'transition.createWithdraw');
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
        $rules = [
            'mount'         => 'numeric',
            'user_id'       => 'numeric|exists:users,id',
            'bank_id'       => 'numeric|exists:banks,id',
            'start_bank_id' => 'numeric|exists:banks,id',
            'type'          => 'numeric|max:200'
        ];
        $this->validate($request, $rules);

        $transition->update($request->only(array_keys($rules)));

        return back()->withErrors(new MessageBag([
            'success' => 'updated successfuly'
        ]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transition $transition
     *
     * @return void
     * @throws \Exception
     */
    public function destroy(Transition $transition)
    {
        if (Auth::user()->can('delete', $transition)) {
            $transition->delete();
            return back()->withErrors(new MessageBag([
                'success' => [
                    'Deleted Transition Successfuly'
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
