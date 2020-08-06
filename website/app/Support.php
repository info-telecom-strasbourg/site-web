<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Model for supports.
 */
class Support extends Model
{
	protected $fillable = ['ref', 'visibility', 'name', 'cours_id'];
	public $timestamps = false;

	/**
	 * Gets the lesson associated to the support.
	 */
    public function cours()
	{
		$this->belongsTo(Cours::class);
	}
}
