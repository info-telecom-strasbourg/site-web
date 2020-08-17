<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $guarded = [];
    
    /**
     * Gets the user who worte the topic.
	 *
	 * @return the author of the topic.
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * Gets the comments of the topic.
	 *
	 * @return the comments of the topic.
     */
    public function comments() {
        return $this->morphMany('App\Comment', 'commentable')->latest();
    }
}
