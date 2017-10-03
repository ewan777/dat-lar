<?php

namespace App\Http\Controllers;

use App\User;
use App\Mail\SignUp;
use Illuminate\Http\Request;
use Auth;

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

    public function postLogin(Request $request){
      $this->validate($request, [
        'email'    => 'email|required',
        'password' => 'required'
      ]);

      $email    = $request->input('email');
      $password    = $request->input('password');
      $user = User::where('email', $email)
        ->first();

      if ($user === null) {
        \Session::flash('flash_warning', 'There is no account matching these credentials, please sign up');
        return redirect()->route('user.signup');
      } else {

        $confirmed = $user->confirmed;
        if ($confirmed){
          if (Auth::attempt(['email'=>$email,'password'=>$password])){
            \Session::flash('flash_message', 'You are now logged in');
            return redirect()->route('user.profile');
          } else{
              \Session::flash('flash_warning', 'Wrong password');
              return redirect()->route('user.login');
          }
        } else {
            \Session::flash('flash_warning', 'Account not activated, use your confirmation email to activate your account, or request a new confirmation email');
            return redirect()->route('home');
        }
      }

    } // end postLogin

} //end of class
