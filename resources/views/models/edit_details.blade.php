@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit ' . studly_case(str_singular($table))) }}</div>
                    <div class="card-body">
                        <div class="card-body">
                            <form method="POST" action="{{ route($name.'.update',$data->id) }}" aria-label="{{ __('Add Bank') }}">
                                @csrf
                                @method('patch')
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

                                @foreach($columns as $column)
                                    @if(!array_search($column,['','id' , 'created_at' , 'updated_at' ,'deleted_at'] ))
                                        <div class="form-group row">
                                            <label for="{{$column}}" class="col-md-4 col-form-label text-md-right">{{ __(studly_case($column)) }}</label>

                                            <div class="col-md-6">
                                                <input id="{{$column}}" type="text" class="form-control{{ $errors->has($column) ? ' is-invalid' : '' }}" name="{{$column}}" value="{{ old($column)?:$data->$column }}">
                                            </div>
                                        </div>
                                    @endif
                                @endforeach

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Edit ' . studly_case(str_singular($table))) }}
                                        </button>
                                        <a href="{{route($backName)}}" class="btn btn-danger">
                                            {{ __('Back to ' . studly_case(str_singular($table))) }}
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection