<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Messages extends Controller
{

  public function getMessage(){
    return view('message.new');
  }

  public function postMessage(Request $request){
    $this->validate($request, [
      'body'   => 'required',
    ]);

    $date = new \DateTime();
    $expires = $date->modify('+1 month');

    $message = new Message([
      'user_id'    =>  \Auth::user()->id,
      'username'   =>  \Auth::user()->username,
      'title'      =>  $request->input('title'),
      'body'       =>  $request->input('body'),
      'expires'    =>  $expires,
    ]);

    $profile->save();
    \Session::flash('flash_message', 'Your message has been sent');
    return redirect()->route('member_page');
  }

}
