@extends('layouts.app')

@section('content')
    <div class="container">
        @yield('second-content')
        @include('models.show_details')
    </div>
@endsection
