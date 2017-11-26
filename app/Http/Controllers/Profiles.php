<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
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

  public function uploadImage(){
    return view('profile.upload_image');
  }

  public function saveImage(Request $request){
    $this->validate($request, [
      'profile_pic'   => 'required|image|dimensions:min_width=100,min_height=100|max:1000',
    ]);
    $user = \Auth::user();
    $file = $request->file('profile_pic');
    $ext = $request->file('profile_pic')->extension();
    $filename = $user->username.'-'.$user->id.'.'.$ext;
    if($file){
      $request->file('profile_pic')->storeAs('profile_pics/'.$user->id, $filename, 'local');
      $profile = Profile::where('user_id', $user->id)->first();
      $profile->image_name = $filename;
      $profile->save();
    }
    return redirect()->route('profile');
  }

  public function profilePic($filename){
    $id = \Auth::user()->id;
    $file = \Storage::disk('local')->get('/profile_pics/'.$id.'/'.$filename);
    return new Response($file, 200);
  }


} //end class
