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
	 *
	 * @return the lesson to witch the support belongs.
	 */
    public function cours()
	{
		$this->belongsTo(Cours::class);
	}
}
