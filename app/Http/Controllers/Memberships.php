<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Memberships extends Controller
{
    public function getMemberPage(){
      return view('member.home');
    }
}
