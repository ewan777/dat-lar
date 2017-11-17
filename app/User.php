<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'sex', 'email', 'password', 'confirmation_code'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function membership(){
      return $this->hasOne('App\Membership');
    }

    public function hasMembership(){
      $membership = $this->membership()->where('user_id', $this->id)->first();
      if ($membership){
        return true;
      }
      return false;
    }

    public function membershipExpired(){
      $membership  = $this->membership()->where('user_id', $this->id)->first();
      $expiry_date_string = $membership->expires;
      $today              = new \DateTime();
      $expiry_date        = new \DateTime($expiry_date_string);

      if ($today > $expiry_date){
        return true;
      } else{
        return false;
      }
    } //end membershipExpired function

    public function removeMembership(){
      $membership  = $this->membership()->where('user_id', $this->id)->first();
      $membership->delete();
    }

    public function profile(){
      return $this->hasOne('App\Profile');
    }

    public function hasProfile(){
      $profile = $this->profile()->where('user_id', $this->id)->first();
      if ($profile){
        return true;
      }
      return false;
    }


}  //end User class
