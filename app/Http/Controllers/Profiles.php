<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;

class Profiles extends Controller
{

  public function getProfile(Request $request){
      if(\Auth::user()->hasProfile()){
        $profile = Profile::where('user_id', \Auth::user()->id)->first();
        return view('profile.index')->with('profile', $profile);
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

    $profile = new Profile([
      'user_id'      =>  \Auth::user()->id,
      'username'     =>  \Auth::user()->username,
      'sex'          =>  \Auth::user()->sex,
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
      $profile = Profile::where('user_id', \Auth::user()->id)->first();
      return view('profile.edit')->with('profile', $profile);
    } else{
       return view('profile.start');
    }
  }

  public function putEdit(Request $request){
    $this->validate($request, [
      'age_group'   => 'required',
      'nationality' => 'required'
    ]);

    Profile::where('user_id', \Auth::user()->id)
      ->update([
        'age_group'   => $request->input('age_group'),
        'nationality' => $request->input('nationality'),
        'about_me'    => $request->input('about_me'),
        'looking_for' => $request->input('looking_for')
      ]);

    \Session::flash('flash_message', 'Your profile has been updated');
    return redirect()->route('profile');
  }


} //end class
