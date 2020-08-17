  @extends('layouts.layout')

  @section('title', 'Boîte à idées')

  @section('content')
    <div class="container">
        <h1 class="title lg text-center">
            Boîte à idées
        </h1>
        <hr class="line-under-title">

        <div class="container pt-3">
            <!-- List all the topics -->
            <div class=".list-group">
                @foreach ($topics as $topic)
                <div class="list-group-item">
                    <h4><a href="{{ route('topics.show', $topic) }}">{{ $topic->title }}</a></h4>
                    <p>{{ $topic->content }}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <small>Posté le {{ $topic->created_at->format('d/m/Y à H:m') }}</small>
                        <span class="badge badge-primary">{{ $topic->user->name }}</span>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-center mt-3">
                {{ $topics->links() }}
            </div>
        </div>

    </div>
  @endsection