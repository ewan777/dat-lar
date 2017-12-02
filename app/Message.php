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
      'user_id', 'to_user_id', 'receiver', 'title', 'body', 'expires'
  ];

  public function user(){
    return $this->belongsTo('App\User');
  }

} // end class
