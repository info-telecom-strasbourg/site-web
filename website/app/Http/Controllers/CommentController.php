<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Topic;
use App\Comment;

class CommentController extends Controller
{
    /**
     * Constructor.
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Gets the comments of the comment.
	 *
	 * @return the comments of the comment.
     */
    public function comments() {
        return $this->morphMany('App\Comment', 'commentable')->latest();
    }

    /**
     * Store a new topic.
     *
     * @param  topic: the topic.
     * @return redirect to the page of the stored topic.
     */
    public function store(Topic $topic) {
        request()->validate([
            'content' => 'required|min:5'
        ]);

        $comment = new Comment();
        $comment->content = request()->content;
        $comment->user_id = auth()->user()->id;

        $topic->comments()->save($comment);

        return redirect()->route('topics.show', $topic);
    }

    /**
     * Store a reply to a comment.
     *
     * @param  topic: the comment.
     * @return redirect to the page of the stored topic.
     */
    public function storeCommentReply(Comment $comment) {
        request()->validate([
            'replyComment' => 'required|min:2'
        ]);

        $commentReply = new Comment();
        $commentReply->content = request('replyComment');
        $commentReply->user_id = auth()->user()->id;

        $comment->comments()->save($commentReply);

        return back();
    }


}
