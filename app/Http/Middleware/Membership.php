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
          // return response("Insufficient Permissions", 401);
          \Session::flash('flash_warning', 'Insufficient Permissions');
          return redirect()->route('home');
        }
        if ($request->user()->hasMembership()){
          return $next($request);
        }
        \Session::flash('flash_warning', 'Insufficient Permissions');
        return redirect()->route('home');
        // return response("Insufficient Permissions", 401);
    }
}
