<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;

use Closure;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$permiso)
    {
        if (Auth::guest()){
            return redirect('/login');
        }
        if (!$request->user()->can($permiso)) {
            abort(403);
        }
        return $next($request);
    }

}