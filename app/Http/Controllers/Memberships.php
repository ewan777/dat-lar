<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
use Auth;

class Memberships extends Controller
{
    public function getMemberPage(){
    $profile = Profile::where('user_id', Auth::user()->id)->first();
      if (Auth::user()->sex == 'male'){
        $user_profiles = Profile::where('sex', 'female')
          ->take(5)
          ->get();
      } else {
        $user_profiles = Profile::where('sex', 'male')
          ->take(5)
          ->get();
      }
      return view('member.index')->with(['profile'=>$profile, 'user_profiles'=> $user_profiles]);
    }

} //end class
