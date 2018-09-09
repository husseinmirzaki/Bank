@extends('models.models')

@section('rn' , __('Withdraw Records'))

@section('second-content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Transition Withdraw') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('transition.store') }}"
                          aria-label="{{ __('Transition Withdraw') }}">
                        @csrf
                        @if($errors->any())
                            @if($errors->has('success'))
                                <div class="alert alert-success">
                                    {{$errors->first('success')}}
                                </div>
                            @else
                                @foreach($errors->all() as $error)
                                    <div class="alert alert-danger">
                                        {{$error}}
                                    </div>
                                @endforeach
                            @endif
                        @endif
                        <div class="form-group row">
                            <label for="mount"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Mount') }}</label>

                            <div class="col-md-6">
                                <input id="mount" type="number"
                                       class="form-control{{ $errors->has('mount') ? ' is-invalid' : '' }}"
                                       name="mount" value="{{ old('mount') }}" required autofocus>
                            </div>
                        </div>

                        <input type="hidden" name="type" value="2">

                        <div class="form-group row">
                            <label for="start_bank_id"
                                   class="col-md-4 col-form-label text-md-right">{{ __('From Bank') }}</label>

                            <div class="col-md-6">
                                <select class="form-control" name="from_bank_id" id="start_bank_id">
                                    <option>Select ...</option>
                                    @foreach(\App\Bank::all()->all() as $bank)
                                        <option value="{{$bank->id}}">{{$bank->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="from_account"
                                   class="col-md-4 col-form-label text-md-right">{{ __('From Account') }}</label>

                            <div class="col-md-6">
                                <select class="form-control" name="from_account_id" id="to_account">
                                    <option>Select ...</option>
                                    @foreach(\App\Account::where('user_id' , Auth::user()->id )->get()->all() as $account)
                                        <option value="{{$account->id}}">{{$account->type}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Add Transition') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection