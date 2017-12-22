<?php

namespace App\Http\Middleware;

use Closure;
use App\Mail\MembershipExpired;

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
          return redirect()->route('home')
            ->with('warning', 'Insufficient Permissions');
        }

        if($request->user()->hasMembership()){

          if($request->user()->membershipExpired()){
            $request->user()->removeMembership();
            $username = $request->user()->username;
            \Mail::to($request->user()->email)
              ->send(new MembershipExpired($username));
            return redirect()->route('home')
              ->with('warning', 'Your membership has expired');
          } else{
            return $next($request);
          }
        }
        return redirect()->route('home')
          ->with('warning', 'Insufficient Permissions');
    }
}
