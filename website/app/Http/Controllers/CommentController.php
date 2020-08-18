<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Topic;
use App\Comment;
use App\Projet;
use App\Pole;
use App\Cours;
use App\Competition;

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
     * Store a comment to a topic.
     *
     * @param  topic: the topic.
     * @return redirect to the page of the topic.
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
     * @return redirect to the page of the comment.
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

    /**
     * Store a comment to a pole.
     *
     * @param  pole: the pole.
     * @return redirect to the page of the pole.
     */
    public function storePole(Pole $pole) {
        request()->validate([
            'content' => 'required|min:5'
        ]);

        $comment = new Comment();
        $comment->content = request()->content;
        $comment->user_id = auth()->user()->id;

        $pole->comments()->save($comment);

        return back();
    }

    /**
     * Store a comment to a lesson.
     *
     * @param  cours: the lesson.
     * @return redirect to the page of the lesson.
     */
    public function storeCours(Cours $cours) {
        request()->validate([
            'content' => 'required|min:5'
        ]);

        $comment = new Comment();
        $comment->content = request()->content;
        $comment->user_id = auth()->user()->id;

        $cours->comments()->save($comment);

        return back();
    }

    /**
     * Store a comment to a competition.
     *
     * @param  compet: the competition.
     * @return redirect to the page of the competition.
     */
    public function storeCompetition(Competition $compet) {
        request()->validate([
            'content' => 'required|min:5'
        ]);

        $comment = new Comment();
        $comment->content = request()->content;
        $comment->user_id = auth()->user()->id;

        $compet->comments()->save($comment);

        return back();
    }
    
    /**
     * Store a comment to a project.
     *
     * @param  projet: the project.
     * @return redirect to the page of the project.
     */
    public function storeProject(Projet $projet) {
        request()->validate([
            'content' => 'required|min:5'
        ]);

        $comment = new Comment();
        $comment->content = request()->content;
        $comment->user_id = auth()->user()->id;

        $projet->comments()->save($comment);

        return redirect()->route('projets.show', $projet);
    }


}
