@extends('layouts.layout')

@section('title', 'Boîte à idées - ' . $topic->title)

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
    <li class="breadcrumb-item"><a href="/topics">Boîte à idées</a></li>
    <li class="breadcrumb-item active">{{ $topic->title }}</li>
@endsection

@section('content')
<div class="container">
    <h1 class="title lg text-center">
        {{ $topic->title }}
    </h1>
    <hr class="line-under-title">

    <div class="container pt-3">
        <div class="card mb-5">
            <div class="card-body">
                <h4 class="card-title">{{ $topic->title }}</h4>
                <p>{{ $topic->content }}</p>
                <div class="d-flex justify-content-between align-items-center">
                    <small>Posté le {{ $topic->created_at->format('d/m/Y à H:i') }}</small>
                    <span class="badge badge-light" data-toggle="tooltip" data-placement="top" title="Auteur">{{ $topic->user->name }}</span>

                </div>
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <!-- Button to update the topic-->
                    @can('update', $topic)
                        <a href="{{ route('topics.edit', $topic) }}" class="btn btn-warning">Éditer cette idée</a>
                    @endcan

                    <!-- Button to delete the topic -->
                    @can('delete', $topic)
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#removeTopic">Supprimer</button>

                        <!-- Modal to confirm removal -->
                        <div class="modal fade" id="removeTopic" tabindex="-1" role="dialog"
                            aria-labelledby="removeTopicLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="removeTopicLabel">Modal title</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Voulez vous vraiment supprimer cette idée ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                                        <form action="{{ route('topics.destroy', $topic) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#removeTopic">Supprimer</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endcan
                </div>
            </div>
        </div>

        <hr>

        @include('partials.comments', ['routeName' => 'comments.store', 'object' => $topic])
    </div>

</div>
@endsection