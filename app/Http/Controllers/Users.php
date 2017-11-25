<?php

namespace App\Http\Controllers;

use App\User;
use App\Mail\Register;
use App\Mail\ResetPassword;
use Illuminate\Http\Request;
use Auth;

class Users extends Controller
{

    public function getRegister(){
      return view('user.register');
    }

    public function postRegister(Request $request){
      $this->validate($request, [
        'name'     => 'required',
        'username' => 'required|unique:users',
        'sex'      => 'required',
        'email'    => 'email|required|unique:users',
        'password' => 'required|confirmed|min:8'
      ]);

      $confirmation_code = str_random(40);

      $user = new User([
        'name'=>              $request->input('name'),
        'username'=>          $request->input('username'),
        'sex'=>               $request->input('sex'),
        'email'=>             $request->input('email'),
        'password'=>          bcrypt($request->input('password')),
        'confirmation_code'=> $confirmation_code
      ]);
      $user->save();

      \Mail::to($user->email)->send(new Register($user->confirmation_code));
      \Session::flash('flash_message', 'you will receive a registration email shortly');
      return redirect()->route('home');
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
        return redirect()->route('user.register');
      } else {

        $confirmed = $user->confirmed;
        if ($confirmed){
          if (Auth::attempt(['email'=>$email,'password'=>$password])){
            \Session::flash('flash_message', 'You are now logged in');
            return redirect()->route('profile');
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

    public function getLogout(){
      Auth::logout();
      \Session::flash('flash_message', 'You have successfully logged out');
      return redirect()->route('home');
    }


    public function getResendActivation(){
      return view('user.resend_activation');
    }

    public function postResendActivation(Request $request){
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
            \Session::flash('flash_message', 'Your account is already activated, you can login');
            return redirect()->route('user.login');
        } else{
          \Mail::to($user->email)->send(new SignUp($user->confirmation_code));
          \Session::flash('flash_message', 'you will receive a confirmation email shortly');
          return redirect()->route('home');
        }
      }
    }

    public function getResetPassword(){
      return view('user.reset_password');
    }

    public function postResetPassword(Request $request){
      $this->validate($request, [
        'email'    => 'email|required'
      ]);

      $email = $request->input('email');
      $user  = User::where('email', $email)
        ->first();
      $reset_code = str_random(40);

      if ($user === null) {
        \Session::flash('flash_warning', 'There is no account matching these credentials, please sign up');
        return redirect()->route('user.signup');
      } else {
        $user->reset_code = $reset_code;
        $user->save();
        \Mail::to($user->email)->send(new ResetPassword($reset_code));
        \Session::flash('flash_message', 'password reset email sent');
        return redirect()->route('home');
      }

    }

    public function getNewPassword($reset_code){
      $user = User::where('reset_code', $reset_code)
        ->first();
      return view('user.new_password')->with('id', $user->id);
    }


    public function postNewPassword(Request $request){
      $this->validate($request, [
        'password' => 'required|confirmed|min:8'
      ]);

      $password = bcrypt($request->input('password'));
      $user_id  = $request->input('user_id');
      $user     = User::where('id', $user_id)
        ->first();

      if ($user === null) {
        \Session::flash('flash_warning', 'There is no account matching these credentials, please sign up');
        return redirect()->route('user.signup');
      } else {
        $user->password = $password;
        $user->save();
        \Session::flash('flash_message', 'Password has been reset');
        return redirect()->route('user.login');
      }

    }


} //end of class
