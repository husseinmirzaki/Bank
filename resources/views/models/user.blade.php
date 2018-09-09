@extends('models.models')

@section('rn' , __('User Records'))

@section('second-content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add User') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('user.store') }}" aria-label="{{ __('Add User') }}">
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
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="family" class="col-md-4 col-form-label text-md-right">{{ __('Family') }}</label>

                            <div class="col-md-6">
                                <input id="family" type="text" class="form-control{{ $errors->has('family') ? ' is-invalid' : '' }}" name="family" value="{{ old('family') }}" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="level" class="col-md-4 col-form-label text-md-right">{{ __('Level') }}</label>

                            <div class="col-md-6">
                                <input id="level" type="text" class="form-control{{ $errors->has('level') ? ' is-invalid' : '' }}" name="level" value="{{ old('level') }}" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" value="{{ old('password') }}" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password_confirmation" class="col-md-4 col-form-label text-md-right">{{ __('Password Confirmation') }}</label>

                            <div class="col-md-6">
                                <input id="password_confirmation" type="password_confirmation" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" value="{{ old('password_confirmation   ') }}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Add User') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
