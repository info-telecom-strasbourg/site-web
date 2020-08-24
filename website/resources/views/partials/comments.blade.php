@section('extra-js')
<script>
/**
 * Toggle the reply comment textarea.
 * 
 * @param id the id of the comment
 */
function toggleReplyComment(id) {
    let element = document.getElementById('replyComment-' + id);
    let textArea = document.getElementById('text-comment-reply-' + id);
    element.classList.toggle('d-none');
    textArea.focus();
}

/**
 * Verify the number of characters for a new comment.
 * If the number of characters is greater than 5, the comment can be submited.
 * Otherwise the button to submit the comment is disabled.
 * 
 * @param val the current element - the textarea
 * @param btnId the id of the button to enable/disable
 */
function verifyNumberOfCharacterForComment(val, btnId) {
    var len = val.value.length;
    var btn = $(btnId);
    if (len >= 5) {
        btn.css('background-color', '#254395');
        btn.css('cursor', 'pointer');
        btn.prop("disabled", false);
    } 
    else {
        btn.css('background-color', 'rgb(204, 204, 204)');
        btn.css('cursor', 'default');
        btn.prop("disabled", true);
    }
};

/**
 * Remove focus to the textarea to add comment.
 * 
 * @param val the current element - the textarea
 * @param btnBoxId the id of the button box containing the cancel and add button
 */
function removeFocus(val, btnBoxId) {
    var btnBox = document.querySelector(btnBoxId);

    val.style.borderColor = '#333';
    btnBox.style.display = 'flex';
};

/**
 * Add focus to the textarea to add comment.
 * 
 * @param val the current element - the textarea
 */
function addFocus(val) {
    val.style.borderColor = '#aaa';
};

/**
 * Add focus to the textarea to add comment.
 * 
 * @param val the current element - the cancel button
 * @param btnBoxId the id of the button box containing the cancel and add button
 * @param textAreaId the id of the textarea to add comment
 */
function clearComment(val, btnBoxId, textAreaId) {
    var btnBox = document.querySelector(btnBoxId);
    var textArea = document.querySelector(textAreaId);

    btnBox.style.display = 'none';
    textArea.value = '';
};

/**
 * Toggle replies container.
 * 
 * @param id the id of the comment for which the replies should be toggled
 */
function toggleReplies(id) {
    let repliesContainer = document.getElementById('replies-' + id);
    let caret = document.getElementById('caret-' + id);

    repliesContainer.classList.toggle('d-none');

    // get the number of replies for the current comment
    let nb = $('.comment-reply-' + id).length;

    // if the replies are hidden
    if (repliesContainer.classList.contains('d-none')) {
        caret.classList.remove('fa-caret-up');
        caret.classList.add('fa-caret-down');
        if (nb > 1)
            $('#text-' + id).text('Afficher les ' + nb + ' réponses');
        else {
            $('#text-' + id).text('Afficher la réponse');
        }
    } 
    else {  // if the replies are shown
        caret.classList.remove('fa-caret-down');
        caret.classList.add('fa-caret-up');
        if (nb > 1)
            $('#text-' + id).text('Masquer les ' + nb + ' réponses');
        else
            $('#text-' + id).text('Masquer la réponse');
    }
}

/**
 * Inserts HTML line breaks before all newlines in a string.
 * 
 * @param str the string to convert
 */
function nl2br(str, is_xhtml) {
    var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />'   : '<br>';
    return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag   + '$2');
}

/**
 * 
 */
function escapeHtml(text) {
  var map = {
    '&': '&amp;',
    '<': '&lt;',
    '>': '&gt;',
    '"': '&quot;',
    "'": '&#039;'
  };
  
  return text.replace(/[&<>"']/g, function(m) { return map[m]; });
}

/**
 * Add a reply to a comment.
 * 
 * @param urlPath the path to the route to store the comment
 * @param textAreaId the id of the textarea to reply to the comment
 * @param nb the number of replies to the comment
 */
function addComment(urlPath, textAreaId, nb) {
    $.ajax({
        type: 'POST',
        url: urlPath,
        data: {
            _token: '{!! csrf_token() !!}',
            replyComment: jQuery(textAreaId).val(),
        },
        success: function(result) {
            console.log(result);

            // Reply comment html
            var commentData = '';
            commentData += '<div class="comment-reply comment-reply-' + result.comment.commentable_id + '">';
            commentData += '    <div class="comment d-flex align-items-start">';
            commentData += '        <div class="comment-author-thumbnail">';
            commentData += "            <a href='/users/" + result.comment.user.id + "'>";
            commentData += '                <img class="profil-rounded-xsmall" src="' + result.path + '">';
            commentData += "            </a>";
            commentData += "        </div>";
            commentData += '        <div class="comment-body d-flex flex-column w-100">';
            commentData += '            <div class="comment-author d-flex">';
            commentData += '                <span class="author-text">' + result.comment.user.name + '</span>';
            commentData += '                <span class="published-time-text">' + result.dateDiff + '</span>';
            commentData += '            </div>';
            commentData += '            <div class="comment-content" id="comment-content-' + result.comment.id + '">' + nl2br(escapeHtml(result.comment.content));  
            commentData += '            </div>';
            commentData += '            <div class="d-flex">';
            commentData += '                <div class="edit-button">';
            commentData += '                    <a data-toggle="modal" data-target="#editCommentModal-' + result.comment.id + '">Modifier</a>';
            commentData += "                </div>";

            commentData += '                <div class="modal fade" id="editCommentModal-' + result.comment.id + '" tabindex="-1" role="dialog" aria-labelledby="editCommentModal-' + result.comment.id + 'Title" aria-hidden="true">';
            commentData += '                    <div class="modal-dialog modal-dialog-centered" role="document">';
            commentData += '                        <div class="modal-content">';
            commentData += '                            <div class="modal-header">';
            commentData += '                                <h5 class="modal-title" id="editCommentModalTitle">Modifier votre commentaire</h5>';
            commentData += '                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">';
            commentData += '                                    <span aria-hidden="true">&times;</span>';
            commentData += '                                </button>';
            commentData += '                            </div>';
            commentData += '                            <div class="modal-body">';
            commentData += '                                <textarea class="w-100" name="content" id="edit-comment-' + result.comment.id + '"rows="10">' + result.comment.content + '</textarea>';
            commentData += '                            </div>';
            commentData += '                            <div class="modal-footer">';
            commentData += '                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>';
            commentData += '                                <button type="button" class="btn btn-primary" onclick="saveChanges(\'/comments/' + result.comment.id + "', " + result.comment.id + ')">Enregistrer</button>';
            commentData += '                            </div>';
            commentData += '                        </div>';
            commentData += '                    </div>';
            commentData += '                </div>';

            commentData += '                <div class="delete-button">';
            commentData += '                    <a onclick="if(confirm(' + "'Voulez vous vraiment supprimer votre commentaire ?')) window.location = '/comments/" + result.comment.id + "/destroy'" + '">SUPPRIMER</a>';
            commentData += "                </div>";

            commentData += "            </div>";
            commentData += "        </div>";
            commentData += "    </div>";
            commentData += "</div>";

            // Prepend the comment reply to the other replies
            $('#replies-' + result.comment.commentable_id).prepend(commentData);

            // Increment the number of replies for the comment
            nb = nb + 1;

            // If the number of replies is 1 show the replies container
            if (nb == 1) {
                $('#text-' + result.comment.commentable_id).text('Masquer la réponse');
                $('#link-see-replies-box-' + result.comment.commentable_id).removeClass('d-none');
            }
            else {
                if ($('#text-' + result.comment.commentable_id).text().includes('Afficher'))
                    $('#text-' + result.comment.commentable_id).text('Afficher les ' + nb + ' réponses');
                else 
                    $('#text-' + result.comment.commentable_id).text('Masquer les ' + nb + ' réponses');
            }

            // Empty the input fields
            $(textAreaId).val('');
            // hide textarea to add comment
            $('#replyComment-' + result.comment.commentable_id).addClass('d-none');

            // show the replies
            $('#replies-' + result.comment.commentable_id).removeClass('d-none');
            $('#caret-' + result.comment.commentable_id).removeClass('fa-caret-down');
            $('#caret-' + result.comment.commentable_id).addClass('fa-caret-up');

        },
        error: function(data, textStatus, errorThrown) {
            // if the user is not logged in - error 401
            if (errorThrown == 'Unauthorized')
                window.location.replace('/login');
        },
    });
}

/**
 * Edit a comment.
 * 
 * @param urlPath the path to the route to update the comment
 * @param id the id of the comment
 */
function saveChanges(urlPath, id) {
    $.ajax({
        type: 'POST',
        url: urlPath,
        data: {
            _token: '{!! csrf_token() !!}',
            _method: 'PUT',
            content: jQuery('#edit-comment-' + id).val(),
        },
        success: function(result) {
            $('#comment-content-' + id).text(result.content);
            $('#editCommentModal-' + id).modal('hide');

        },
        error: function(data, textStatus, errorThrown) {
            // if the user is not logged in - error 401
            if (errorThrown == 'Unauthorized')
                window.location.replace('/login');
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
        placeholder="Ajouter un commentaire..." onkeyup="verifyNumberOfCharacterForComment(this, '#submit-comment')"
        onfocus="removeFocus(this, '#add-comment')" onblur="addFocus(this)">{{ old('content') }}</textarea>
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
                    else if ($days > 1 && $days < 7) { $name="il y a $days jours" ; } else { $name="aujourd'hui à " . $comment->created_at->format('H:i'); }
                        @endphp 
                        <span class="published-time-text">{{ $name }}</span>
                </div>
                <div class="comment-content" id="comment-content-{{$comment->id}}">
                    {!! nl2br(htmlspecialchars($comment->content)) !!}
                </div>

                <div class="d-flex">
                    <!-- Button reply to comment -->
                    <div class="reply-button">
                        <a onclick="toggleReplyComment({{ $comment->id }})">RÉPONDRE</a>
                    </div>
                    
                    <!-- Button edit comment -->
                    @can ('update', $comment)
                    <div class="edit-button">
                        <a data-toggle="modal" data-target="#editCommentModal-{{ $comment->id }}">
                            Modifier
                        </a>
                    </div>
                    @endcan

                    <!-- Modal to edit comment -->
                    @include('partials.modal-edit-comment', ['comment' => $comment])

                    <!-- Button remove comment -->
                    @can ('delete', $comment)
                    <div class="delete-button">
                        <a onclick="if(confirm('Voulez vous vraiment supprimer votre commentaire ?')) window.location = '/comments/{{ $comment->id }}/destroy'">SUPPRIMER</a>
                    </div>
                    @endcan
                </div>

                <!-- Reply to the current comment form -->
                <form class="mb-3 d-none" id="replyComment-{{ $comment->id }}">
                    @csrf

                    <textarea id="text-comment-reply-{{ $comment->id }}" name="replyComment"
                        class="add-comment @error('content') is-invalid @enderror" placeholder="Ajouter une réponse..."
                        onkeyup="verifyNumberOfCharacterForComment(this, '#submit-reply-{{ $comment->id }}')"
                        onfocus="removeFocus(this, '#add-reply-{{ $comment->id }}')"
                        onblur="addFocus(this)">{{ old('replyComment') }}</textarea>
                    @error('replyComment')
                    <span class="invalid-feedback" role="alert" style="margin-bottom: 10px;">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <div id="add-reply-{{ $comment->id }}" class="add-comment-btn-box justify-content-end">
                        <button class="add-comment-btn add-comment-cancel" type="button"
                            onclick="clearComment(this, '#add-reply-{{ $comment->id }}', '#text-comment-reply-{{ $comment->id }}'); toggleReplyComment({{ $comment->id }});">ANNULER</button>
                        <input id="submit-reply-{{ $comment->id }}" class="add-comment-btn add-comment-btn-submit"
                            type="button" disabled value="RÉPONDRE" onclick="addComment('/commentsReply/{{ $comment->id }}', '#text-comment-reply-{{ $comment->id }}', {{ $comment->comments->count() }})">
                    </div>
                </form>

                
                <div onclick="toggleReplies('{{ $comment->id }}')" id="link-see-replies-box-{{ $comment->id }}"
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
                        else if ($days > 1 && $days < 7) { $name="il y a $days jours" ; } else { $name="aujourd'hui à " . $comment->created_at->format('H:i');  }
                            @endphp <span class="published-time-text">{{ $name }}</span>
                    </div>
                    <div class="comment-content" id="comment-content-{{ $replyComment->id }}">
                        {!! nl2br(htmlspecialchars($replyComment->content)) !!}
                    </div>

                    <div class="d-flex">
                        <!-- Button edit comment -->
                        @can ('update', $replyComment)
                        <div class="edit-button">
                            <a data-toggle="modal" data-target="#editCommentModal-{{ $replyComment->id }}">
                                Modifier
                            </a>
                        </div>
                        @endcan

                        <!-- Modal to edit comment -->
                        @include('partials.modal-edit-comment', ['comment' => $replyComment])

                        <!-- Button remove comment -->
                        @can ('delete', $replyComment)
                        <div class="delete-button">
                            <a onclick="if(confirm('Voulez vous vraiment supprimer votre commentaire ?')) window.location = '/comments/{{ $replyComment->id }}/destroy'">SUPPRIMER</a>
                        </div>
                        @endcan
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