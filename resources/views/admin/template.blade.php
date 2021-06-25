@extends('layouts.app')

@section('content')

    <div class="row" style="margin:0">
        <div class="col-md-12">
            <h1 class="text-center library-h1 my-3">
                @yield('h1')
            </h1>

            @yield('mycontent')
        </div>
    </div>

    
@endsection