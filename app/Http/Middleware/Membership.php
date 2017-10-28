<?php

namespace App\Http\Middleware;

use Closure;

class Membership
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
        if ($request->user() == null) {
          return response("Insufficient Permissions", 401);
        }
        if ($request->user()->hasMembership()){
          return $next($request);
        }
        return response("Insufficient Permissions", 401);
    }
}
