<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::check() || !(Auth::user()->role_id == 1 || Auth::user()->role_id == 2 || Auth::user()->role_id == 4)) {
            return redirect('/');
        }
        return $next($request);
    }
}
