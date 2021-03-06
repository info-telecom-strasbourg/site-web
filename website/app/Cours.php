<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Model for lessons.
 */
class Cours extends Model
{
	protected $guarded = [];
	public $timestamps = false;

	/**
	 * Get the list of creators of the lesson.
	 *
	 * @return the creators of the leson.
	 */
    public function creators()
    {
        return $this->belongsToMany(User::class, 'cours_createurs')->orderBy('name');
    }

	/**
	 * Get the references of a lesson.
	 *
	 * @return the support of a lesson.
	 */
    public function supports()
    {
        return $this->hasMany(Support::class);
    }

	/**
	 * Get the list of dates for a lesson.
	 */
	public function dates()
	{
		return $this->belongsToMany(Date::class, 'dates_cours');
	}

	/**
	 * Get the tags of a lesson.
	 */
	public function tags()
	{
		return $this->belongsToMany(Tag::class, 'tags_cours');
	}

	/**
     * Gets the comments of the cours.
	 *
	 * @return the comments of the cours.
     */
    public function comments() {
        return $this->morphMany('App\Comment', 'commentable')->latest();
    }
}
