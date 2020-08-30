<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Model for competitions.
 */
class Competition extends Model
{
	protected $guarded = [];
	public $timestamps = false;

	/**
	 * Get the competitors for a competition.
	 *
	 * @return all the competitors of a competition.
	 */
	public function competitors()
    {
        return $this->belongsToMany(User::class, 'user_compet');
    }

	/**
	 * Get the list of dates for a competition.
	 *
	 * @return the dates of the competition.
	 */
	public function dates()
	{
		return $this->belongsToMany(Date::class, 'dates_comp');
	}

	/**
     * Gets the comments of the competition.
	 *
	 * @return the comments of the competition.
     */
    public function comments() {
        return $this->morphMany('App\Comment', 'commentable')->latest();
    }
}
