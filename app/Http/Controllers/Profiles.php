<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Profiles extends Controller
{
  public function getProfile(Request $request){
    return view('profile.index');
  }

  public function getNew(){
    return view('profile.new');
  }

  public function postNew(Request $request){

  }


} //end class
