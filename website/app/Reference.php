<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
	protected $fillable = ['ref', 'visibility', 'name', 'cours_id'];
	public $timestamps = false;

	/**
	 *
	 */
    public function cours()
	{
		$this->belongsTo(Cours::class);
	}
}
