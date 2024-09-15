<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class wali extends Controller
{
    public function index(){
        return view('wali.wali');
    }
}
