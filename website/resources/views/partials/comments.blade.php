@section('extra-js')
<script>
function toggleReplyComment(id, textAreaId) {
    let element = document.getElementById('replyComment-' + id);
    let textArea = document.getElementById(textAreaId);
    element.classList.toggle('d-none');
    textArea.focus();
}

function countChar(val, btnId) {
    var len = val.value.length;
    var btn = $(btnId);
    if (len >= 5) {
        btn.css('background-color', '#254395');
        btn.css('cursor', 'pointer');
        btn.prop("disabled", false);
    } else {
        btn.css('background-color', 'rgb(204, 204, 204)');
        btn.css('cursor', 'default');
        btn.prop("disabled", true);
    }
};

function removePlaceholder(val, btn) {
    var btnBox = document.querySelector(btn);

    val.style.borderColor = '#333';
    btnBox.style.display = 'flex';
};

function addPlaceholder(val) {
    val.style.borderColor = '#aaa';
};

function clearComment(val, btn, textAreaId) {
    var btnBox = document.querySelector(btn);
    var textArea = document.querySelector(textAreaId);

    btnBox.style.display = 'none';
    textArea.value = '';
};

function toggleReplies(id) {
    let repliesContainer = document.getElementById('replies-' + id);
    let caret = document.getElementById('caret-' + id);

    repliesContainer.classList.toggle('d-none');

    let nb = $('.comment-reply-' + id).length;

    if (repliesContainer.classList.contains('d-none')) {
        caret.classList.remove('fa-caret-up');
        caret.classList.add('fa-caret-down');
        if (nb > 1)
            $('#text-' + id).text('Afficher les ' + nb + ' réponses');
        else {
            $('#text-' + id).text('Afficher la réponse');
        }
    } 
    else {
        caret.classList.remove('fa-caret-down');
        caret.classList.add('fa-caret-up');
        if (nb > 1)
            $('#text-' + id).text('Masquer les ' + nb + ' réponses');
        else
            $('#text-' + id).text('Masquer la réponse');
    }
}

function nl2br(str, is_xhtml) {
    var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />'   : '<br>';
    return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag   + '$2');
}

function addComment(urlPath, textArea, commentReplyBox, repliesCounter, nb) {
    $.ajax({
        type: 'POST',
        url: urlPath,
        data: {
            _token: '{!! csrf_token() !!}',
            replyComment: jQuery(textArea).val(),

        },
        success: function(result) {

            // Display comment
            var commentData = '<div class="comment-reply comment-reply-' + result.comment.commentable_id + '">';
            commentData += '<div class="comment d-flex align-items-start">';
            commentData += '<div class="comment-author-thumbnail">';
            commentData += "<a href='/users/" + result.user.id + "'>";
            commentData += '<img class="profil-rounded-xsmall" src="' + result.path + '">';
            commentData += "</a>";
            commentData += "</div>";
            commentData += '<div class="comment-body d-flex flex-column w-100">';
            commentData += '<div class="comment-author d-flex">';
            commentData += '<span class="author-text">' + result.user.name + '</span>';
            commentData += '<span class="published-time-text">' + result.dateDiff + '</span>';
            commentData += '</div>';
            commentData += '<div class="comment-content">' + nl2br(result.comment.content);  
            commentData += '</div>';
            commentData += "</div>";
            commentData += "</div>";

            nb = nb + 1;

            $(commentReplyBox).prepend(commentData);

            if (nb == 1) {
                $(repliesCounter).text('Masquer la réponse');
                $('#link-see-replies-box-' + result.comment.commentable_id).removeClass('d-none');
            }
            else {
                if ($(repliesCounter).text().includes('Afficher'))
                    $(repliesCounter).text('Afficher les ' + nb + ' réponses');
                else 
                    $(repliesCounter).text('Masquer les ' + nb + ' réponses');
            }

            // Empty the input fields
            $(textArea).val('');
            $('#replyComment-' + result.comment.commentable_id).addClass('d-none');

            // show the replies
            $('#replies-' + result.comment.commentable_id).removeClass('d-none');
            $('#caret-' + result.comment.commentable_id).removeClass('fa-caret-down');
            $('#caret-' + result.comment.commentable_id).addClass('fa-caret-up');

        },
        error: function(data, textStatus, errorThrown) {
            console.log(data);
        },
    });
}
</script>
@endsection

<h5 style="margin-bottom: 24px;">{{ $object->comments->count() }} commentaires</h5>

<!-- Add a comment -->
<form action="{{ route($routeName, $object) }}" method="POST" class="mb-3">
    @csrf
    <textarea id="text-comment" name="content" class="add-comment @error('content') is-invalid @enderror"
        placeholder="Ajouter un commentaire..." onkeyup="countChar(this, '#submit-comment')"
        onfocus="removePlaceholder(this, '#add-comment')" onblur="addPlaceholder(this)">{{ old('content') }}</textarea>
    @error('content')
    <span class="invalid-feedback" role="alert" style="margin-bottom: 10px;">
        <strong>{{ $message }}</strong>
    </span>
    @enderror

    <div id="add-comment" class="add-comment-btn-box justify-content-end">
        <button class="add-comment-btn add-comment-cancel" type="button"
            onclick="clearComment(this, '#add-comment', '#text-comment')">ANNULER</button>
        <input id="submit-comment" class="add-comment-btn add-comment-btn-submit" type="submit" disabled
            value="AJOUTER UN COMMENTAIRE">
    </div>

</form>

<!-- List all comments -->
<div id="comments">
    @forelse ($object->comments as $comment)
    <div class="comment-thread">

        <!-- Card for a comment -->
        <div class="comment d-flex align-items-start">
            <div class="comment-author-thumbnail">
                <a href="{{ route('users.show', $comment->user) }}">
                    <img class="profil-rounded-small" src="{{ asset('storage/' . $comment->user->profil_picture) }}">
                </a>
            </div>
            <div class="comment-body d-flex flex-column w-100">
                <div class="comment-author d-flex">
                    <span class="author-text">{{ $comment->user->name }}</span>

                    @php
                    /**
                    * Get the time difference with the current day.
                    */

                    $days = $comment->created_at->diffInDays();
                    $weeks = $comment->created_at->diffInWeeks();
                    $months = $comment->created_at->diffInMonths();
                    $years = $comment->created_at->diffInYears();

                    if ($years == 1) {
                    $name = "il y $years an";
                    }
                    else if ($years > 1) {
                    $name = "il y a $years ans";
                    }
                    else if ($months >= 1) {
                    $name = "il y a $months mois";
                    }
                    else if ($weeks == 1) {
                    $name = "il y a $weeks semaine";
                    }
                    else if ($weeks >= 1) {
                    $name = "il y a $weeks semaines";
                    }
                    else if ($days == 1) {
                    $name = "il y a $days jour";
                    }
                    else if ($days > 1 && $days < 7) { $name="il y a $days jours" ; } else { $name="aujourd'hui" ; }
                        @endphp 
                        <span class="published-time-text">{{ $name }}</span>
                </div>
                <div class="comment-content">
                    {!! nl2br($comment->content) !!}
                </div>

                <!-- Button reply to comment -->
                <div class="reply-button">
                    <a onclick="toggleReplyComment({{ $comment->id }}, 'text-comment-reply-{{ $comment->id }}')">RÉPONDRE</a>
                </div>

                <!-- Reply to the current comment form -->
                <!-- <form action="{{ route('comments.storeReply', $comment) }}" method="POST" class="mb-3 d-none"
                    id="replyComment-{{ $comment->id }}"> -->
                <form class="mb-3 d-none" id="replyComment-{{ $comment->id }}">
                    @csrf

                    <textarea id="text-comment-reply-{{ $comment->id }}" name="replyComment"
                        class="add-comment @error('content') is-invalid @enderror" placeholder="Ajouter une réponse..."
                        onkeyup="countChar(this, '#submit-reply-{{ $comment->id }}')"
                        onfocus="removePlaceholder(this, '#add-reply-{{ $comment->id }}')"
                        onblur="addPlaceholder(this)">{{ old('replyComment') }}</textarea>
                    @error('replyComment')
                    <span class="invalid-feedback" role="alert" style="margin-bottom: 10px;">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <div id="add-reply-{{ $comment->id }}" class="add-comment-btn-box justify-content-end">
                        <button class="add-comment-btn add-comment-cancel" type="button"
                            onclick="clearComment(this, '#add-reply-{{ $comment->id }}', '#text-comment-reply-{{ $comment->id }}'); toggleReplyComment({{ $comment->id }});">ANNULER</button>
                        <input id="submit-reply-{{ $comment->id }}" class="add-comment-btn add-comment-btn-submit"
                            type="button" disabled value="RÉPONDRE" onclick="addComment('/commentsReply/{{ $comment->id }}', '#text-comment-reply-{{ $comment->id }}', '#replies-{{ $comment->id }}', '#text-{{ $comment->id }}', {{ $comment->comments->count() }})">
                    </div>
                </form>

                
                <div onclick="toggleReplies('{{ $comment->id }}', {{ $comment->comments->count() }})" id="link-see-replies-box-{{ $comment->id }}"
                    class="link-see-replies-box @if ($comment->comments->count() < 1) d-none @endif">
                    <i id="caret-{{ $comment->id }}" class="fas fa-caret-down"></i>
                    @if ($comment->comments->count() < 1)
                    <span id="text-{{ $comment->id }}" class="link-see-replies"></span>
                    @elseif ($comment->comments->count() > 1)
                    <span id="text-{{ $comment->id }}" class="link-see-replies">Afficher les
                        {{ $comment->comments->count() }} réponses</span>
                    @else
                    <span id="text-{{ $comment->id }}" class="link-see-replies">Afficher la réponse</span>
                    @endif
                </div>
            </div>
        </div>

        <div id="replies-{{ $comment->id }}" class="replies d-none">
            <!-- List all replies to the current comment -->
            @foreach ($comment->comments as $replyComment)

            <!-- Card for a comment reply -->
            <div class="comment-reply comment-reply-{{ $comment->id }} @if ($loop->index <= 5) d-flex align-items-start @endif">
                <div class="comment-author-thumbnail">
                    <a href="{{ route('users.show', $comment->user) }}">
                        <img class="profil-rounded-xsmall"
                            src="{{ asset('storage/' . $comment->user->profil_picture) }}">
                    </a>
                </div>
                <div class="comment-body d-flex flex-column w-100">
                    <div class="comment-author d-flex">
                        <span class="author-text">{{ $replyComment->user->name }}</span>

                        @php
                        /**
                        * Get the time difference with the current day.
                        */

                        $days = $comment->created_at->diffInDays();
                        $weeks = $comment->created_at->diffInWeeks();
                        $months = $comment->created_at->diffInMonths();
                        $years = $comment->created_at->diffInYears();

                        if ($years == 1) {
                        $name = "il y $years an";
                        }
                        else if ($years > 1) {
                        $name = "il y a $years ans";
                        }
                        else if ($months >= 1) {
                        $name = "il y a $months mois";
                        }
                        else if ($weeks == 1) {
                        $name = "il y a $weeks semaine";
                        }
                        else if ($weeks >= 1) {
                        $name = "il y a $weeks semaines";
                        }
                        else if ($days == 1) {
                        $name = "il y a $days jour";
                        }
                        else if ($days > 1 && $days < 7) { $name="il y a $days jours" ; } else { $name="aujourd'hui" ; }
                            @endphp <span class="published-time-text">{{ $name }}</span>
                    </div>
                    <div class="comment-content">
                        {!! nl2br($replyComment->content) !!}
                    </div>
                </div>
            </div>
            @endforeach

            <!-- Button to see more replies -->
            @if(isset($comment->comments) && $comment->comments->count() > 6)
            <div class="more-comments more-comments-{{ $comment->id }}"
                onclick="seeMoreComments('comment-reply', '.more-comments-{{ $comment->id }}')">
                Afficher plus de réponses
            </div>
            @endif

        </div>
    </div>
    @empty
    @endforelse
</div>


<!-- Button to see more -->
@if(isset($object->comments) && $object->comments->count() > 6)
@include('partials.voirplus', ['id' => 'comment', 'element' => 'comment-thread'])
@endif