@extends('models.models')

@section('rn' , __('Account Records'))

@section('second-content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Account') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('account.store') }}" aria-label="{{ __('Add Account') }}">
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
                            <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Type') }}</label>

                            <div class="col-md-6">
                                <select class="form-control" name="type" id="type">
                                    <option>Select ...</option>
                                    <option value="1">Basic checking Account</option>
                                    <option value="2">Savings Account</option>
                                    <option value="3">Interest bearing checking Account</option>
                                    <option value="4">CD's</option>
                                    <option value="5">IRAs</option>
                                    <option value="6">Brokerage Accounts</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="bank_id" class="col-md-4 col-form-label text-md-right">{{ __('In Bank') }}</label>

                            <div class="col-md-6">
                                <select class="form-control" name="bank_id" id="type">
                                    <option>Select ...</option>
                                    @foreach(\App\Bank::all()->all() as $bank)
                                        <option value="{{$bank->id}}">{{$bank->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Add Account') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection