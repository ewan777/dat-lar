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
      $user = User::create([
        'name'=>              $request->input('name'),
        'username'=>          $request->input('username'),
        'sex'=>               $request->input('sex'),
        'email'=>             $request->input('email'),
        'password'=>          bcrypt($request->input('password')),
        'confirmation_code'=> $confirmation_code
      ]);

      \Mail::to($user->email)->send(new Register($user->confirmation_code));
      return redirect()->route('home')
        ->with('flash_message', 'you will receive a registration email shortly');
    }

    public function getRegistered($confirmation_code){
      $user = User::where('confirmation_code', $confirmation_code)
        ->first();
      $user->confirmed = true;
      $user->save();
      return redirect()->route('user.login')
        ->with('flash_message', 'You can now log in');
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
        return redirect()->route('user.register')
          ->with('flash_warning', 'There is no account matching these credentials, please sign up');
      } else {

        $confirmed = $user->confirmed;
        if ($confirmed){
          if (Auth::attempt(['email'=>$email,'password'=>$password])){
            return redirect()->route('profile', Auth::user()->id)
              ->with('flash_message', 'You are now logged in');
          } else{
              return redirect()->route('user.login')
                ->with('flash_warning', 'Wrong password');
          }
        } else {
            return redirect()->route('home')
              ->with('flash_warning', 'Account not activated, use your confirmation email to activate your account, or request a new confirmation email');
        }
      }

    } // end postLogin

    public function getLogout(){
      Auth::logout();
      return redirect()->route('home')
        ->with('flash_message', 'You have successfully logged out');
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
        return redirect()->route('user.signup')
          ->with('flash_warning', 'There is no account matching these credentials, please sign up');
      } else {

        $confirmed = $user->confirmed;
        if ($confirmed){
            return redirect()->route('user.login')
              ->with('flash_message', 'Your account is already activated, you can login');
        } else{
          \Mail::to($user->email)->send(new Register($user->confirmation_code));
          return redirect()->route('home')
            ->with('flash_message', 'you will receive a confirmation email shortly');
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
        return redirect()->route('user.signup')
          ->with('flash_warning', 'There is no account matching these credentials, please sign up');
      } else {
        $user->reset_code = $reset_code;
        $user->save();
        \Mail::to($user->email)->send(new ResetPassword($reset_code));
        return redirect()->route('home')
          ->with('flash_message', 'password reset email sent');
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
        return redirect()->route('user.signup')
          ->with('flash_warning', 'There is no account matching these credentials, please sign up');
      } else {
        $user->password = $password;
        $user->save();
        return redirect()->route('user.login')
          ->with('flash_message', 'Password has been reset');
      }

    }


} //end of class
