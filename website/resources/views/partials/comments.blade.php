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
<form action="{{ route($routeName, $object) }}" method="POST" class="mb-3">
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

<!-- List all comments -->
@forelse ($object->comments as $comment)
    <div class="comment">
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
            <div class="card mb-2 ml-5 comment-reply">
                <div class="card-body">
                    {{ $replyComment->content }}
                    <div class="d-flex justify-content-between align-items-center">
                        <small>Posté le {{ $replyComment->created_at->format('d/m/Y') }}</small>
                        <span class="badge badge-primary">{{ $replyComment->user->name }}</span>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Button to see more replies -->
        @if(isset($comment->comments) && $comment->comments->count() > 6)
            @include('partials.voirplus', ['id' => $comment->id, 'element' => 'comment-reply'])
        @endif
    </div>
@empty
@endforelse


<!-- Button to see more -->
@if(isset($object->comments) && $object->comments->count() > 6)
	@include('partials.voirplus', ['id' => 'comment', 'element' => 'comment'])
@endif
