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
    
    @if (session('warning'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {!! session('warning') !!}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="d-flex justify-content-end align-items-center my-5 mx-4">
        <a href="{{ route('admin.livres.create') }}" class="btn btn-link library-btn text-white">Nouveau livre</a>
    </div>

    <div class="table-responsive">
        <table class="text-center table table-borderless table-striped table-hover">
            <thead>
                <th>Titre</th>
                <th>Auteur</th>
                <th>Note</th>
                <th>Avis</th>
                <th>Date de création</th>
                <th>Paramètres</th>
            </thead>
            <tbody>
                @foreach ($livres as $livre)
                    <tr>
                        <td>{{ $livre->title }}</td>
                        <td>{{ $livre->author }}</td>
                        <td>{{ $livre->rating }}</td>
                        <td>
                            <a href="{{ route('admin.livres.show', $livre->id) }}" class="btn btn-success">Lire</a>
                        </td>
                        <td>{{ $livre->created_at->format('d/m/Y à H:i:s') }}</td>
                        <td class="d-md-flex justify-content-center align-items-center">
                            <a href="" class="btn btn-info text-white my-1 mr-md-1">Modifier</a>
                            <form action="{{ route('admin.livres.delete', $livre->id) }}" method="POST" class="my-1 ml-md-1">
                                @csrf
                                @method('delete')
                                <input type="submit" class="btn btn-danger" value="Supprimer" onclick="return confirm('Confirmer la suppression ?')" />
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection