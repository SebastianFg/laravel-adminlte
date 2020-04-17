<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Cache;
Use Carbon\Carbon;

class LastUserActivity
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
        if (Auth::check()) {
            $expireAt = Carbon::now()->addMinutes(2);
            Cache::put('user-is-online-'. Auth::User()->id, true,$expireAt);
        }
        return $next($request);
    }
}
