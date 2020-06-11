<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cours extends Model
{
	protected $guarded = [];

	/* Return the list of creators of the lesson */
    public function creators()
    {
        return $this->hasMany(User::class);
    }

	/* List the refereneces of a lesson */
    // public function references()
    // {
    //     return ;
    // }

	/* Return the list of dates for a lesson */
	// public function dates()
	// {
	// 	return
	// }
}
