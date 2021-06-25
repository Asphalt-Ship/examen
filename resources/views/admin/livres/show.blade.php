@extends('admin.template')

@section('h1')
    Avis sur : {{ $livre->title }}
@endsection

@section('mycontent')

    <div class="container my-5">
        "{{ $livre->review }}"
    </div>

    <div class="d-flex justify-content-end align-items-center my-5 mx-4">
        <a href="{{ route('admin.index') }}" class="btn btn-link library-btn text-white">Retour à l'index</a>
    </div>

@endsection