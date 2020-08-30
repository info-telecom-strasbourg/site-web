<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = [];

    /**
	 * Get the parent models of Comment.
	 *
	 * @return all the parent models of Comment.
	 */
    public function commentable() {
        return $this->morphTo();
    }

    /**
     * Gets the comments reply of the comment.
	 *
	 * @return the comments reply of the comment.
     */
    public function comments() {
        return $this->morphMany('App\Comment', 'commentable')->latest();
    }

    /**
     * Gets the user who wrote this comment.
	 *
	 * @return the comment author.
     */
    public function user() {
        return $this->belongsTo(User::class);
    }
}
