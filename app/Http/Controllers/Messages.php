<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\User;
use Auth;

class Messages extends Controller
{

  public function getMessage($receiver_id){
    return view('message.new')->with('receiver_id', $receiver_id);
  }

  public function postMessage(Request $request, $receiver_id){
    $this->validate($request, [
      'body'   => 'required',
    ]);

    $date = new \DateTime();
    $expires = $date->modify('+1 month');
    $to   = User::where('id', $receiver_id)->first();
    $from = User::where('id', Auth::user()->id)->first();
    $receiver = $to->username;
    $sender = $from->username;

    $message = new Message([
      'receiver_id' =>  $receiver_id,
      'receiver'    =>  $receiver,
      'sender_id'   =>  Auth::user()->id,
      'sender'      =>  $sender,
      'title'       =>  $request->input('title'),
      'body'        =>  $request->input('body'),
      'expires'     =>  $expires
    ]);

    $message->save();
    return redirect()->route('member_page', Auth::user()->id)
      ->with('success', 'Your message has been sent');
  }

  public function sentMessages($sender_id){
    $messages = Message::where('sender_id', $sender_id)
      ->orderBy('id', 'desc')
      ->get();
    return view('message.sent_messages')->with('messages', $messages);
  }

  public function myMessages($receiver_id){
    $messages = Message::where('receiver_id', $receiver_id)
      ->orderBy('id', 'desc')
      ->get();
    return view('message.my_messages')->with('messages', $messages);
  }


  public function getReply($message_id){
    $reply_to_message = Message::where('id', $message_id)->first();
    $receiver_id = $reply_to_message->sender_id;

    return view('message.reply')->with([
      'reply_to_message'=>$reply_to_message,
      'receiver_id'=>$receiver_id
    ]);
  }

  public function postReply(Request $request, $receiver_id){
    $this->validate($request, [
      'body'   => 'required',
    ]);

    $reply_to_message_id = $request->input('reply_to_message_id');
    $reply_to_message = Message::where('id', $reply_to_message_id)->first();

    $date = new \DateTime();
    $expires = $date->modify('+1 month');
    $to = User::where('id', $receiver_id)->first();
    $receiver = $to->username;
    $from = User::where('id', Auth::user()->id)->first();
    $sender = $from->username;

    $message = new Message([
      'receiver_id'        =>  $receiver_id,
      'receiver'           =>  $receiver,
      'sender_id'          =>  Auth::user()->id,
      'sender'             =>  $sender,
      'replying_to_title'  =>  $reply_to_message->title,
      'replying_to_body'   =>  $reply_to_message->body,
      'title'              =>  $request->input('title'),
      'body'               =>  $request->input('body'),
      'expires'            =>  $expires
    ]);

    $message->save();
    return redirect()->route('member_page', Auth::user()->id)
      ->with('success', 'Your message has been sent');
  }
} //end class
