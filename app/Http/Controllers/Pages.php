<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Pages extends Controller
{

  public function home() {
    return view('pages.home')->with('title', 'Home');
  }

  public function about() {
    return view('pages.about')->with('title', 'About');
  }

}
