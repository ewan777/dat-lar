<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Profile;
use Image;
use File;
use Auth;

class Profiles extends Controller
{

  public function getProfile($user_id){
    $user = User::where('id', $user_id)->first();

    if( $user->hasProfile() ){
      $profile = Profile::where('user_id', $user_id)->first();

      if ($profile->sex == 'male'){
        $user_profiles = Profile::where('sex', 'female')
          ->take(5)
          ->get();
      } else {
        $user_profiles = Profile::where('sex', 'male')
          ->take(5)
          ->get();
      }

      return view('profile.index')->with(['profile'=>$profile,
        'user_profiles'=>$user_profiles]);

    } else{
      return view('profile.start')
        ->with('user', $user);
    }
  } //end function


  public function getNew($user_id){
    $user = User::where('id', $user_id)->first();
    if($user->hasProfile()){
      return view('profile.index')
        ->with('user', $user);
    } else {
       return view('profile.new')
        ->with('user_id', $user_id);
    }
  }

  public function postNew(Request $request, $user_id){
    $user = User::where('id', $user_id)->first();

    $this->validate($request, [
      'age_group'   => 'required',
      'nationality' => 'required'
    ]);

    $profile = new Profile([
      'user_id'      =>  $user->id,
      'username'     =>  $user->username,
      'sex'          =>  $user->sex,
      'about_me'     =>  $request->input('about_me'),
      'age_group'    =>  $request->input('age_group'),
      'nationality'  =>  $request->input('nationality'),
      'looking_for'  =>  $request->input('looking_for')
    ]);

    $profile->save();
    return redirect()->route('profile', ['user_id' => $user_id])
      ->with('success', 'Profile created, now add a picture');
  }

  public function getEdit($user_id){
    $user = User::where('id', $user_id)->first();
    if($user->hasProfile()){
      $profile = Profile::where('user_id', $user_id)->first();
      return view('profile.edit')->with('profile', $profile);
    } else{
       return view('profile.start')
        ->with('user', $user);
    }
  }

  public function putEdit(Request $request, $user_id){
    $this->validate($request, [
      'age_group'   => 'required',
      'nationality' => 'required'
    ]);

    Profile::where('user_id', $user_id)
      ->update([
        'age_group'   => $request->input('age_group'),
        'nationality' => $request->input('nationality'),
        'about_me'    => $request->input('about_me'),
        'looking_for' => $request->input('looking_for')
      ]);

    return redirect()->route( 'profile', ['user_id' => $user_id] )
      ->with('success', 'Your profile has been updated');
  }

  public function uploadImage($user_id){
    return view('profile.upload_image')
      ->with('user_id', $user_id);
  }

  public function saveImage(Request $request, $user_id){
    $this->validate($request, [
      'profile_pic'   => 'required|image|dimensions:min_width=100,min_height=100|max:1000',
    ]);
    $user = User::where('id', $user_id)->first();
    $file = $request->file('profile_pic');
    $ext = $file->getClientOriginalExtension();
    $filename = $user->username.'-'.$user->id.'.'.$ext;
    $location = public_path('images/profile_pics/'.$user->id.'/'.$filename);
    if(!File::exists('images/profile_pics/'.$user->id)) {
      File::makeDirectory( public_path('images/profile_pics/'.$user->id) );
    }
    Image::make($file)->fit(325, 250)->save($location);

    $profile = Profile::where('user_id', $user->id)->first();
    $profile->image_name = $filename;
    $profile->save();
    return redirect()->route('profile', ['user_id'=>$user_id]);

  } //end public function




} //end class
