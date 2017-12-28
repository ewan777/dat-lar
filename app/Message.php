<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */

  protected $fillable = [
      'sender_id', 'receiver_id', 'replying_to_title', 'replying_to_body', 'receiver', 'sender', 'title', 'body', 'expires'
  ];

  public function user(){
    return $this->belongsTo('App\User');
  }

} // end class
