<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cours extends Model
{
	protected $guarded = [];

	/**
	* Get the list of creators of the lesson
	*/
    public function creators()
    {
        return $this->belongsToMany(User::class, 'cours_createurs');
    }

	/**
	* Get the refereneces of a lesson
	*/
    public function refs()
    {
        return $this->belongsToMany(Reference::class, 'refs_cours');
    }

	/**
	* Get the list of dates for a lesson
	*/
	public function dates()
	{
		return $this->belongsToMany(Date::class, 'dates_cours');
	}

	/**
	* Get the tags of a lesson
	*/
	public function tags()
	{
		return $this->belongsToMany(Tag::class, 'tags_cours');
	}
}
