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
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get the time difference with the current day.
     * @param myDate the timestamps
     * @return name the displayed text of the time that has pasted since the comment has been added
     */
    public function diffTime($myDate)
    {
        $days = $myDate->diffInDays();
        $weeks = $myDate->diffInWeeks();
        $months = $myDate->diffInMonths();
        $years = $myDate->diffInYears();

        if ($years == 1) {
            $name = "il y $years an";
        } else if ($years > 1) {
            $name = "il y a $years ans";
        } else if ($months >= 1) {
            $name = "il y a $months mois";
        } else if ($weeks == 1) {
            $name = "il y a $weeks semaine";
        } else if ($weeks >= 1) {
            $name = "il y a $weeks semaines";
        } else if ($days == 1) {
            $name = "il y a $days jour";
        } else if ($days > 1 && $days < 7) {
            $name = "il y a $days jours";
        } else {
            $name = "aujourd'hui à " . $myDate->format('H:i');
        }

        return $name;
    }

    /**
     * Store a comment to a topic.
     *
     * @param  topic: the topic.
     * @return redirect to the page of the topic.
     */
    public function store(Topic $topic)
    {
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
    public function storeCommentReply(Comment $comment)
    {
        request()->validate([
            'replyComment' => 'required|min:2'
        ]);

        $commentReply = new Comment();
        $commentReply->content = request('replyComment');
        $commentReply->user_id = auth()->user()->id;

        $comment->comments()->save($commentReply);

        // Path to user profil picture
        $pathProfilPicture = asset('storage/' . $commentReply->user->profil_picture);

        // Get the time difference with the current day
        $dateDiff = $this->diffTime($commentReply->created_at);

        return response()->json(['comment' => $commentReply, 'path' => $pathProfilPicture, 'dateDiff' => $dateDiff]);
    }

    /**
     * Store a comment to a pole.
     *
     * @param  pole: the pole.
     * @return redirect to the page of the pole.
     */
    public function storePole(Pole $pole)
    {
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
    public function storeCours(Cours $cours)
    {
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
    public function storeCompetition(Competition $compet)
    {
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
    public function storeProject(Projet $projet)
    {
        request()->validate([
            'content' => 'required|min:5'
        ]);

        $comment = new Comment();
        $comment->content = request()->content;
        $comment->user_id = auth()->user()->id;

        $projet->comments()->save($comment);

        return redirect()->route('projets.show', $projet);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Comment $comment)
    {
        $this->authorize('update', $comment);

        $data = request()->validate([
            'content' => 'required|min:5'
        ]);

        $comment->update($data);

        return response()->json(['content' => $comment->content]);
    }

    /**
     * Remove the specified comment.
     *
     * @param comment: the comment to delete.
     * @return redirect to comments' index view.
     */
    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        // delete the associate comments
        foreach ($comment->comments as $replyComment)
            $replyComment->delete();

        $comment->delete();

        return back();
    }
}
