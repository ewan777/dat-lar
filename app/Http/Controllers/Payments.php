<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;

class Payments extends Controller
{

  public function getPayment(){
    return view('payment.pay');
  }

  public function postPayment(Request $request){
    $key = 'sk_test_9fxtSiRagKmJSefIXroROoap';
    Stripe::setApiKey($key);
    $token = $request->input('stripeToken');

    try {
      Charge::create(array(
        "amount"=>30 * 100,
        "currency"=>"usd",
        "source"=>$token,
        "description"=>"testing testing"
      ));
    } catch(\Exception $e){
        \Session::flash('flash_warning', $e->getMessage());
        return redirect()->route('payment');
    }

    \Session::flash('flash_message', 'Payment Accepted');
    return redirect()->route('home');

  }

} //end class
