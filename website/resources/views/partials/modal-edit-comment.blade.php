<div class="modal fade" id="editCommentModal-{{ $comment->id }}" tabindex="-1" role="dialog"
    aria-labelledby="editCommentModal-{{ $comment->id }}Title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCommentModalTitle">Modifier votre commentaire</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <textarea class="w-100" name="content" id="edit-comment-{{ $comment->id }}"
                    rows="10">{{ $comment->content }}</textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary"
                    onclick="saveChanges('/comments/{{ $comment->id }}', {{ $comment->id }})">Enregistrer</button>
            </div>
        </div>
    </div>
</div>