<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\User;
use Auth;

class Messages extends Controller
{

  public function getMessage($to_user_id){
    return view('message.new')->with('to_user_id', $to_user_id);
  }

  public function postMessage(Request $request, $to_user_id){
    $this->validate($request, [
      'body'   => 'required',
    ]);

    $date = new \DateTime();
    $expires = $date->modify('+1 month');
    $to = User::where('id', $to_user_id)->first();
    $receiver = $to->username;

    $message = new Message([
      'to_user_id' =>  $to_user_id,
      'receiver'   =>  $receiver,
      'user_id'    =>  Auth::user()->id,
      'title'      =>  $request->input('title'),
      'body'       =>  $request->input('body'),
      'expires'    =>  $expires
    ]);

    $message->save();
    return redirect()->route('profile', Auth::user()->id)
      ->with('success', 'Your message has been sent');
  }

  public function sentMessages($user_id){
    $messages = Message::where('user_id', $user_id)->get();
    return view('message.sent_messages')->with('messages', $messages);
  }

} //end class
