<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebController extends Controller
{
  public function index()
  {
    return view('web.index');
  }
  public function soon()
  {
    return view('web.soon');
  }
}
