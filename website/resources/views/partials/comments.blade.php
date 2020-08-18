@section('extra-js')
    <script>
        function toggleReplyComment(id) {
            let element = document.getElementById('replyComment-' + id);
            element.classList.toggle('d-none');
        }
    
    </script>
@endsection

<h5>Commentaires</h5>

<!-- Add a comment -->
@if (isset($topic))
    <form action="{{ route('comments.store', $topic) }}" method="POST" class="mb-3">
@elseif (isset($pole))
    <form action="{{ route('comments.poles.pole.store', $pole) }}" method="POST" class="mb-3">
@elseif (isset($cours))
    <form action="{{ route('comments.poles.cours.store', $cours) }}" method="POST" class="mb-3">
@elseif (isset($compet))
    <form action="{{ route('comments.poles.competition.store', $compet) }}" method="POST" class="mb-3">
@elseif (isset($projet))
    <form action="{{ route('comments.projets.store', $projet) }}" method="POST" class="mb-3">
@endif

    @csrf
    <div class="form-group">
        <label for="content">Votre commentaire</label>
        <textarea class="form-control @error('content') is-invalid @enderror" name="content" rows="5"
            required>{{ old('content') }}</textarea>

        @error('content')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Commenter</button>
</form>

<!-- Get the comments to list -->
@if (isset($topic))
    @php 
        $comments = $topic->comments;
    @endphp
@elseif (isset($pole))
    @php 
        $comments = $pole->comments;
    @endphp
@elseif (isset($cours))
    @php 
        $comments = $cours->comments;
    @endphp
@elseif (isset($compet))
    @php 
        $comments = $compet->comments;
    @endphp

@elseif (isset($projet))
    @php 
        $comments = $projet->comments;
    @endphp
@endif

<!-- List all comments -->
@forelse ($comments as $comment)
    <div class="card mb-2">
        <div class="card-body">
            {{ $comment->content }}
            <div class="d-flex justify-content-between align-items-center">
                <small>Posté le {{ $comment->created_at->format('d/m/Y') }}</small>
                <span class="badge badge-primary">{{ $comment->user->name }}</span>
            </div>
        </div>
    </div>

    @auth
        <!-- Button reply to comment -->
        <button class="btn btn-info mb-3" onclick="toggleReplyComment({{ $comment->id }})">Répondre</button>

        <!-- Reply to the current comment form -->
        <form action="{{ route('comments.storeReply', $comment) }}" method="POST" class="mb-3 ml-5 d-none"
            id="replyComment-{{ $comment->id }}">
            @csrf
            <div class="form-group">
                <label for="replyComment">Ma réponse</label>
                <textarea class="form-control @error('replyComment') is-invalid @enderror" name="replyComment" rows="5"
                    required>{{ old('replyComment') }}</textarea>

                @error('replyComment')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Répondre</button>
        </form>
    @endauth

    <!-- List all replies to the current comment -->
    @foreach ($comment->comments as $replyComment)
        <div class="card mb-2 ml-5">
            <div class="card-body">
                {{ $replyComment->content }}
                <div class="d-flex justify-content-between align-items-center">
                    <small>Posté le {{ $replyComment->created_at->format('d/m/Y') }}</small>
                    <span class="badge badge-primary">{{ $replyComment->user->name }}</span>
                </div>
            </div>
        </div>
    @endforeach

    @empty
    @endforelse