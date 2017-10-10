<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Payments extends Controller
{

  public function getPayment(){
    return view('payment.pay');
  }

  public function postPayment(){
  }

}
