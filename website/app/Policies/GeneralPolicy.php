<?php

namespace App\Policies;

use App\Comment;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class GeneralPolicy
{
    static function checkAdmin()
    {
        return Auth::user()->role_id == 1 || Auth::user()->role_id == 2 || Auth::user()->role_id == 4;
    }
}