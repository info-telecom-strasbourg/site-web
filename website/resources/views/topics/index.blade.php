@extends('layouts.layout')

@section('title', 'Boîte à idées')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
    <li class="breadcrumb-item active">Boîte à idées</li>
@endsection

@section('content')
<div class="container">
    <h1 class="title lg text-center">
        Boîte à idées
    </h1>
    <hr class="line-under-title">

    <div class="container pt-3">
        <div class="text-center mb-4">
            Vous pouvez poster ici vos idées de projets, d'amélioration.
        </div>
        <div class="d-flex justify-content-center mb-5">
            @can('create', 'App\Topic')
            <a href="{{ route('topics.create') }}" class="btn btn-warning">Ajouter une idée</a>
            @endcan
        </div>

        <!-- List all the topics -->
        <div class="list-group">
            @foreach ($topics as $topic)
            <a href="{{ route('topics.show', $topic) }}" class="list-group-item list-group-item-action"
                style="color: #212529;">
                <div class="d-flex justify-content-between align-items-center">
                    <h5>{{ $topic->title }}</h5>
                    <span class="badge badge-primary badge-pill" data-toggle="tooltip" data-placement="top"
                        title="Nombre de commentaires">{{ $topic->comments->count() }}</span>
                </div>
                <p style="word-wrap: break-word;">{{ mb_strlen( $topic->content ) > 220 ? mb_substr($topic->content, 0, 220) . ' ...' : $topic->content }}</p>
                <div class="d-flex justify-content-between align-items-center">
                    <small>Posté le {{ $topic->created_at->format('d/m/Y à H:m') }}</small>
                    <span class="badge badge-light" data-toggle="tooltip" data-placement="top"
                        title="Auteur">{{ $topic->user->name }}</span>
                </div>
            </a>
            @endforeach
        </div>
        <div class="d-flex justify-content-center mt-3">
            {{ $topics->links() }}
        </div>
    </div>

</div>
@endsection