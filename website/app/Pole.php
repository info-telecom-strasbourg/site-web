<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Model for poles.
 */
class Pole extends Model
{
    protected $guarded = [];
	public $timestamps = false;


	/**
     * Return the responsible of the pole.
	 *
	 * @return the user in charge of this pole.
     */
    public function respo()
    {
        return $this->belongsTo(User::class);
    }

	/**
     * Return all the projects of the pole.
	 *
	 * @return all the projects of a pole.
     */
    public function projets()
    {
        return $this->hasMany(Projet::class)->orderBy('id', 'DESC');
    }

    /**
     * Gets the comments of the pole.
	 *
	 * @return the comments of the pole.
     */
    public function comments() {
        return $this->morphMany('App\Comment', 'commentable')->latest();
    }

  /**
	 * Get the timeline of the pole.
	 *
	 * @return the pole's timeline.
	 */
	 public function timeline()
	 {
		 return $this->morphMany(TimelineEvent::class, 'reference', 'timeline_type')->latest('date');
	 }
}
