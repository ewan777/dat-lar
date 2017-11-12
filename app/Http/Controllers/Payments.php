<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use App\User;
use App\Membership;
use Auth;

class Payments extends Controller
{

  public function getPayment(){
    if (Auth::user() == null) {
      \Session::flash('flash_warning', 'Insufficient Permissions');
      return redirect()->route('home');
    }
    if (Auth::user()->hasMembership()){
      \Session::flash('flash_message', 'You already have membership');
      return redirect()->route('home');
    }
    return view('payment.pay');
  }

  public function postPayment(Request $request){
    $key = 'sk_test_9fxtSiRagKmJSefIXroROoap';
    Stripe::setApiKey($key);
    $token = $request->input('stripeToken');

    try {
      $charge = Charge::create(array(
        "amount"=>30 * 100,
        "currency"=>"usd",
        "source"=>$token,
        "description"=>"testing testing"
      ));

      $user = Auth::user();
      $user_id = $user->id;
      $date = new \DateTime();
      $expires = $date->modify('+1 year');

      $membership = new Membership();
      $membership->user_id = $user_id;
      $membership->payment_id = $charge->id;
      $membership->expires = $expires;
      $membership->save();

    } catch(\Exception $e){
        \Session::flash('flash_warning', $e->getMessage());
        return redirect()->route('payment');
    }

    \Session::flash('flash_message', 'Payment Accepted, You Now Have VIP Privileges');
    return redirect()->route('user.profile');

  }

} //end class
