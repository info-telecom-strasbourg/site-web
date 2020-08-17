@extends('layouts.layout')

@section('title', 'Boîte à idées')

@section('content')
    <div class="container">
        <h1 class="title lg text-center">
            Créer une idée
        </h1>
        <hr class="line-under-title">

        <div class="container pt-3">
            <form action="{{ route('topics.store') }}" method="POST">
                @csrf

                <!-- Idea title -->
                <div class="form-group">
                    <label for="title" class="form-title-small">Titre de l'idée</label>

                    <input class="form-control @error('title') is-invalid @enderror title" id="title" name="title" required
                        value="{{ old('title') }}">

                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Idea description -->
                <div class="form-group">
                    <label for="content" class="form-title-small">Votre idée</label>

                    <textarea class="form-control @error('content') is-invalid @enderror content"
                        name="content" rows="5" required>{{ old('content') }}</textarea>

                    @error('content')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Button to create the project -->
                <div class="text-center" style="margin-top:25px; margin-bottom:25px">
                    <button type="submit" class="btn btn-primary btn-rounded">AJOUTER</button>
                </div>
            </form>
        </div>

    </div>
@endsection