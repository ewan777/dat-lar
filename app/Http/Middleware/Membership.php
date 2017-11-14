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
          \Session::flash('flash_warning', 'Insufficient Permissions');
          return redirect()->route('home');
        }

        if($request->user()->hasMembership()){

          if($request->user()->membershipExpired()){
            $request->user()->removeMembership();
            $username = $request->user()->username;
            \Mail::to($request->user()->email)
            ->send(new MembershipExpired($username));
            \Session::flash('flash_warning', 'Your membership has expired');
            return redirect()->route('home');
          } else{
            return $next($request);
          }
        }

        \Session::flash('flash_warning', 'Insufficient Permissions');
        return redirect()->route('home');
    }
}
