<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;

class Profiles extends Controller
{

  public function getProfile(Request $request){
      if(\Auth::user()->hasProfile()){
        return view('profile.index');
      } else{
         return view('profile.start');
      }
  }

  public function getNew(){
    if(\Auth::user()->hasProfile()){
      return view('profile.index');
    } else {
       return view('profile.new');
    }
  }

  public function postNew(Request $request){

    $this->validate($request, [
      'age_group'   => 'required',
      'nationality' => 'required'
    ]);

    $user_id = \Auth::user()->id;

    $profile = new Profile([
      'user_id'      =>  $user_id,
      'about_me'     =>  $request->input('about_me'),
      'age_group'    =>  $request->input('age_group'),
      'nationality'  =>  $request->input('nationality'),
      'looking_for'  =>  $request->input('looking_for')
    ]);
    $profile->save();
    \Session::flash('flash_message', 'Profile created, now add a picture');
    return redirect()->route('profile');
  }

  public function getEdit(){
    if(\Auth::user()->hasProfile()){
      return view('profile.edit');
    } else{
       return view('profile.start');
    }
  }

  public function postEdit(){

  }


} //end class
