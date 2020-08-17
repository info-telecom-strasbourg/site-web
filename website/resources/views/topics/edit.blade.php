@extends('layouts.layout')

@section('title', 'Boîte à idées - {{ $topic->title }}')

@section('content')
    <div class="container">
        <h1 class="title lg text-center">
            {{ $topic->title }}
        </h1>
        <hr class="line-under-title">

        <div class="container pt-3">
            <form action="{{ route('topics.update', $topic) }}" method="POST">
                @csrf
                @method('PATCH')

                <!-- Idea title -->
                <div class="form-group">
                    <label for="title" class="form-title-small">Titre de l'idée</label>

                    <input class="form-control @error('title') is-invalid @enderror title" id="title" name="title" required
                        value="{{ $topic->title }}">

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
                        name="content" rows="5" required>{{ $topic->content }}</textarea>

                    @error('content')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Button to create the project -->
                <div class="text-center" style="margin-top:25px; margin-bottom:25px">
                    <button type="submit" class="btn btn-primary btn-rounded">Enregistrer</button>
                </div>
            </form>
        </div>

    </div>
@endsection