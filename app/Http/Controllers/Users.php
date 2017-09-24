<?php

namespace App\Http\Controllers;

use App\User;
use App\Mail\SignUp;
use Illuminate\Http\Request;

class Users extends Controller
{

    public function getSignup(){
      return view('user.signup');
    }

    public function postSignup(Request $request){
      $this->validate($request, [
        'name'     => 'required',
        'username' => 'required|unique:users',
        'email'    => 'email|required|unique:users',
        'password' => 'required|confirmed|min:8'
      ]);

      $confirmation_code = str_random(40);

      $user = new User([
        'name'=>$request->input('name'),
        'username'=>$request->input('username'),
        'email'=>$request->input('email'),
        'password'=>bcrypt($request->input('password')),
        'confirmation_code'=>$confirmation_code
      ]);
      $user->save();

      \Mail::to($user->email)->send(new SignUp($user->confirmation_code));
      \Session::flash('flash_message', 'you will receive a confirmation email shortly');
      return redirect()->route('home');
    }

    public function getProfile(Request $request){
      return view('user.profile');
    }

    public function getRegistered($confirmation_code){
      $user = User::where('confirmation_code', $confirmation_code)
        ->first();
      $user->confirmed = 1;
      $user->save();

      \Session::flash('flash_message', 'You can now log in');
      return redirect()->route('user.login');
    }

    public function getLogin(){
      return view('user.login');
    }

} //end of class
