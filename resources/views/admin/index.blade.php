@extends('admin.template')

@section('h1', "Index des livres")

@section('mycontent')

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {!! session('success') !!}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    
    <div class="d-flex justify-content-end align-items-center my-5 mx-4">
        <a href="{{ route('admin.books.create') }}" class="btn btn-link library-btn text-white">Nouveau livre</a>
    </div>

    <div class="table-responsive">
        <table class="text-center table table-hover">
            <thead>
                <th>Titre</th>
                <th>Auteur</th>
                <th>Note</th>
                <th>Avis</th>
                <th>Date de création</th>
                <th>Paramètres</th>
            </thead>
            <tbody>
                @foreach ($books as $book)
                    <tr>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->rating }}</td>
                        <td>{{ $book->review }}</td>
                        <td>{{ $book->created_at }}</td>
                        <td>
                            <a href="" class="btn btn-info text-white">Modifier</a>
                            <a href="" class="btn btn-danger">Supprimer</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection