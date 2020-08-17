@extends('layouts.layout')

@section('title', 'Boîte à idées - {{ $topic->title }}')

@section('content')
<div class="container">
    <h1 class="title lg text-center">
        {{ $topic->title }}
    </h1>
    <hr class="line-under-title">

    <div class="container pt-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $topic->title }}</h5>
                <p>{{ $topic->content }}</p>
                <div class="d-flex justify-content-between align-items-center">
                    <small>Posté le {{ $topic->created_at->format('d/m/Y à H:m') }}</small>
                    <span class="badge badge-primary">{{ $topic->user->name }}</span>

                </div>
                <div class="d-flex justify-content-between align-items-center mt-5">
                    <a href="{{ route('topics.edit', $topic) }}" class="btn btn-warning">Editer cette idée</a>
                    <form action="{{ route('topics.destroy', $topic) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Surppimer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection