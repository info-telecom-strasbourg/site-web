<?php

namespace App;

use App\News;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    public $timestamps = false;
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'desc', 'image', 'link', 'button', 'position',
    ];
}
