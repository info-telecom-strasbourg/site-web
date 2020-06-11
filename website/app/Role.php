<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	protected $guarded = [];

    public function respo()
    {
        return $this->hasMany(User::class);
    }
}
