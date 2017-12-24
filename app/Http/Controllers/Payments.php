<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use App\User;
use App\Membership;
use Auth;
use App\Jobs\PaymentReceiptJob;

class Payments extends Controller
{

  public function getPayment(){
    if (Auth::user() == null) {
      return redirect()->route('home')
        ->with('warning', 'Insufficient Permissions');
    }
    if (Auth::user()->hasMembership()){
      return redirect()->route('home')
        ->with('success', 'You already have membership');
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
        return redirect()->route('payment')
          ->with('warning', $e->getMessage());
    }
    dispatch(new PaymentReceiptJob($user));
    return redirect()->route('profile', ['user_id'=>$user_id])
      ->with('success', 'Payment Accepted, You Now Have VIP Privileges');
  }

} //end class
