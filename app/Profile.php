<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'user_id', 'about_me', 'age_group', 'nationality', 'looking_for'
  ];

  public function user(){
    return $this->belongsTo('App\User');
  }

}
