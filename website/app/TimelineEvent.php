<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TimelineEvent extends Model
{
	public $timestamps = false;
	/**
     * Not mass assignable attributes.
     *
     * @var array
     */
    protected $guarded = ['id'];

	public function timeLineMorph()
	{
		return $this->morphTo();
	}
}
