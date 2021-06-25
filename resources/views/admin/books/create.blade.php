@extends('admin.template')

@section('h1', 'Nouveau livre')
    
@section('mycontent')

    <div class="d-flex justify-content-end align-items-center my-5 mx-4">
        <a href="{{ route('admin.index') }}" class="btn btn-link library-btn text-white">Retour à l'index</a>
    </div>
    
    <form action="{{ route('admin.books.store') }}" method="POST" class="container my-5">
        @csrf
        <div class="form-group">
            <label for="title">Titre du livre</label>
            <input id="title" name="title" type="text" class="form-control" value="{{ old('title') }}" />
            <div class="text-danger">{{ $errors->first("title", ":message") }}</div>
        </div>
        <div class="form-group">
            <label for="author">Nom de l'auteur</label>
            <input id="author" name="author" type="text" class="form-control" value="{{ old('author') }}" />
            <div class="text-danger">{{ $errors->first("author", ":message") }}</div>
        </div>
        <div class="form-group">
            <label for="rating">Note /20</label>
            <input id="rating" name="rating" type="number" min="0" max="20" class="form-control" value="{{ old('rating') }}" />
            <div class="text-danger">{{ $errors->first("rating", ":message") }}</div>
        </div>
        <div class="form-group">
            <label for="review">Avis</label>
            <textarea name="review" id="review" cols="30" rows="10" class="form-control">{{ old('review') }}</textarea>
            <div class="text-danger">{{ $errors->first("review", ":message") }}</div>
        </div>
        <div class="form-group text-center">
            <input type="submit" class="btn btn-link library-btn text-white" value="Enregistrer" />
        </div>
    </form>

@endsection