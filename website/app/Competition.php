<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
	public function competitors()
    {
        return $this->belongsToMany(User::class, 'user_compet');
    }


}
